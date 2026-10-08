<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAdminAccountRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AccountSettingsController extends Controller
{
    public function edit(): View
    {
        return view('admin.account-settings.edit');
    }

    public function update(UpdateAdminAccountRequest $request): RedirectResponse
    {
        $user = $request->user();
        $data = $request->validated();

        $user->email = strtolower(trim($data['email']));

        if (! empty($data['password'])) {
            $user->password = $data['password'];
        }

        $user->save();
        $request->session()->regenerate();

        return redirect()
            ->route('admin.account-settings.edit')
            ->with('status', 'Account settings updated.');
    }
}