<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

class clientController extends Controller
{
    //TODO A supprimer/a renommer (function test transmission front/backend)
    public function afficherInformations()
    {
        $users = User::all();
        sleep(20);
        return response()->json(['users' => $users]);
    }

    public function index(Request $request)
    {
        $users = User::all();
        return response()->json([$users]);
    }

    public function store()
    {
        DB::table('users')
            ->where('id', 1)
            ->update(['name' => request('content')]);
        return response()->json([], 200);
    }
}
