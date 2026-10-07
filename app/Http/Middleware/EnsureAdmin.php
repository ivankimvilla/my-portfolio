<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $adminEmail = strtolower(trim((string) config('admin.email')));
        $userEmail = strtolower((string) $request->user()?->email);

        abort_unless(
            $adminEmail !== '' && hash_equals($adminEmail, $userEmail),
            403,
        );

        return $next($request);
    }
}