<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class CheckPin
{
    public function handle(Request $request, Closure $next): Response
    {
        $protectedRoutes = [
            'update.pin',
            'rekap-tendik',
            'filter-tendik',
        ];

        $currentRouteName = Route::currentRouteName();

        if (!in_array($currentRouteName, $protectedRoutes)) {
            $request->session()->forget('pin');
        } else {
            $pin = $request->session()->get('pin');

            if (!$pin) {
                return redirect()->route('pin')->with('error', 'Please enter your PIN to access this route.');
            }
        }

        return $next($request);
    }
}
