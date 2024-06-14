<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GuestLoginController extends Controller
{
    public function login(Request $request){
        $user = User::create([
            'username' => 'ゲスト',
            'email' => 'guest@example.com',
            'password' => Hash::make(Str::random(10)),
            'role' => 'guest'
        ]);
        $token = Str::random(60);
        $guest = Guest::create([
            'user_id' => $user->id,
            'token' => hash('sha256', $token),
            'expired_at' => now()->addHours(2), // 2時間後を有効期限に
        ]);

        Auth::login($user);

        // セッションIDの再生成
        $request->session()->regenerate();
        session()->put('guest_token', $token);
        
        if(!$guest->expired_at > now() || !auth()->check() || !session()->get('guest_token')){
            return back();
        }

        return redirect()->route('top');
    }
}
