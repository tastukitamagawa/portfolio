<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GuestLoginController extends Controller
{
    public function guest(){
        $gustUserId = 1;
        $user = User::find($gustUserId);
        Auth::login($user);
        return redirect('/');
    }
}
