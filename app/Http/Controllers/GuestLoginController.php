<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class GuestLoginController extends Controller
{
    public function guest(){
        try{
            $gustUserId = 1;
            $user = User::find($gustUserId);
            Auth::login($user);
            return redirect('/');
        } catch(\Exception $e){
            Log::error('Error updating word: ' . $e->getMessage());
        }
    }
}
