<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    public function getCurrentUserInformation()
    {
        $user =  Auth::user();
        return response()->json(['user' => $user]);
    }
}