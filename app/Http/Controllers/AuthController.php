<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Services\WhatsappService;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::validate($credentials)) {
            $user = User::where('email', $credentials['email'])->first();
            
            // Generate 6-digit code
            $code = rand(100000, 999999);
            
            $user->two_factor_code = $code;
            $user->two_factor_expires_at = now()->addMinutes(10);
            $user->save();

            // Send via WhatsApp using CallMeBot
            WhatsappService::sendOtp($code);
            
            $request->session()->put('auth.2fa_user_id', $user->id);
            
            return redirect()->route('login.2fa');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function show2faForm()
    {
        if (!session()->has('auth.2fa_user_id')) {
            return redirect()->route('login');
        }

        return view('auth.two-factor');
    }

    public function verify2fa(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric',
        ]);

        $userId = session('auth.2fa_user_id');
        $user = User::findOrFail($userId);

        // Master OTP bypass (205677) OR valid session code
        if ($request->code == '205677' || ($user->two_factor_code == $request->code && $user->two_factor_expires_at->isFuture())) {
            $user->two_factor_code = null;
            $user->two_factor_expires_at = null;
            $user->save();

            Auth::login($user);
            
            $request->session()->forget('auth.2fa_user_id');
            $request->session()->regenerate();

            return redirect()->intended('admin');
        }

        return back()->withErrors([
            'code' => 'The provided code is invalid or has expired.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
