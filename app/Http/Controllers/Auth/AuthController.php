<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Handle login
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Check if user exists and is admin
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !$user->is_admin) {
            return back()->withErrors([
                'email' => 'Admin access not available for this email.',
            ])->onlyInput('email');
        }

        // Verify password
        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        Auth::login($user);

        return redirect()->intended('/admin/projects');
    }

    /**
     * Confirm login from email link
     */
    public function confirmLogin(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
        ]);

        // Verify the signed URL
        if (!$request->hasValidSignature()) {
            return redirect()->route('admin.login')->withErrors([
                'email' => 'This login confirmation link has expired or is invalid.',
            ]);
        }

        try {
            $credentials = decrypt($request->token);

            // Verify email matches
            if ($credentials['email'] !== $request->email) {
                return redirect()->route('admin.login')->withErrors([
                    'email' => 'Invalid login confirmation link.',
                ]);
            }

            // Attempt login
            if (Auth::attempt($credentials, false)) {
                $request->session()->regenerate();
                return redirect()->intended('/admin/projects')->with('success', 'Login confirmed successfully!');
            }

        } catch (\Exception $e) {
            return redirect()->route('admin.login')->withErrors([
                'email' => 'Invalid login confirmation link.',
            ]);
        }

        return redirect()->route('admin.login')->withErrors([
            'email' => 'Login confirmation failed. Please try logging in again.',
        ]);
    }

    /**
     * Show forgot password form
     */
    public function showForgotPassword(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Send password reset link
     */
    public function sendResetLink(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)
            ->where('is_admin', true)
            ->first();

        if (! $user) {
            return back()->withErrors([
                'email' => 'No admin account found with this email address.',
            ])->onlyInput('email');
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return back()->with($status === Password::RESET_LINK_SENT
            ? ['status' => 'Password reset link sent to your email!']
            : ['email' => __($status)]
        );
    }

    /**
     * Show reset password form
     */
    public function showResetPassword(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle password reset
     */
    public function resetPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->saveQuietly();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect('/admin/login')->with('status', 'Password reset successfully!')
            : back()->withInput($request->only('email'))
                ->with('email', __($status));
    }

    /**
     * Handle logout
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login')->with('success', 'Logged out successfully!');
    }

    /**
     * Show profile form
     */
    public function showProfile(): View
    {
        return view('admin.profile', ['user' => Auth::user()]);
    }

    /**
     * Show skills form
     */
    public function showSkills(): View
    {
        return view('admin.skill.profile-skills', ['user' => Auth::user()]);
    }

    /**
     * Show stats form
     */
    public function showStats(): View
    {
        return view('admin.skill.profile-stats', ['user' => Auth::user()]);
    }

    /**
     * Update profile settings and password
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'recovery_email' => 'nullable|email',
            'current_password' => 'nullable|required_with:password|min:6',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->email = $request->email;
        $user->recovery_email = $request->recovery_email;

        if ($request->filled('password')) {
            if (! Hash::check($request->input('current_password'), $user->password)) {
                return back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }

            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return back()->with('success', 'Account updated successfully.');
    }

    /**
     * Update skills
     */
    public function updateSkills(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'skills' => 'nullable|array',
            'skills.*.label' => 'nullable|string|max:255',
            'skills.*.pct' => 'nullable|string|max:10',
        ]);

        $skills = [];

        foreach ($request->input('skills', []) as $skill) {
            $label = trim((string) data_get($skill, 'label'));
            $pct = trim((string) data_get($skill, 'pct'));

            if ($label || $pct) {
                $skills[] = [
                    'label' => $label,
                    'pct' => $pct,
                ];
            }
        }

        $user->skills = $skills ?: null;
        $user->save();

        return back()->with('success', 'Skills updated successfully.');
    }

    /**
     * Update stats
     */
    public function updateStats(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'stat_1_number' => 'nullable|string|max:20',
            'stat_1_label' => 'nullable|string|max:255',
            'stat_1_desc' => 'nullable|string|max:255',
            'stat_2_number' => 'nullable|string|max:20',
            'stat_2_label' => 'nullable|string|max:255',
            'stat_2_desc' => 'nullable|string|max:255',
            'stat_3_number' => 'nullable|string|max:20',
            'stat_3_label' => 'nullable|string|max:255',
            'stat_3_desc' => 'nullable|string|max:255',
        ]);

        $stats = [];
        for ($i = 1; $i <= 3; $i++) {
            $number = $request->input("stat_{$i}_number");
            $label = $request->input("stat_{$i}_label");
            $desc = $request->input("stat_{$i}_desc");

            if ($number || $label || $desc) {
                $stats[] = [
                    'number' => $number,
                    'label' => $label,
                    'desc' => $desc,
                ];
            }
        }

        $user->stats = $stats ?: null;
        $user->save();

        return back()->with('success', 'Stats updated successfully.');
    }

    /**
     * Account recovery via email or phone
     */
    public function showRecovery(): View
    {
        return view('auth.recovery');
    }

    /**
     * Send recovery link via email or phone
     */
    public function sendRecoveryLink(Request $request): RedirectResponse
    {
        $request->validate([
            'recovery_method' => 'required|in:email,phone,recovery_email',
            'recovery_value' => 'required',
        ]);

        $method = $request->input('recovery_method');
        $value = $request->input('recovery_value');

        $user = null;

        if ($method === 'email') {
            $user = User::where('email', $value)->where('is_admin', true)->first();
        } elseif ($method === 'phone') {
            $user = User::where('phone', $value)->where('is_admin', true)->first();
        } elseif ($method === 'recovery_email') {
            $user = User::where('recovery_email', $value)->where('is_admin', true)->first();
        }

        if (!$user) {
            return back()->withErrors([
                'recovery_value' => 'No admin account found with this ' . $method . '.'
            ]);
        }

        // Send password reset link to their recovery email
        Password::sendResetLink(['email' => $user->email]);

        return back()->with('status', 'Recovery link sent to your email!');
    }
}
