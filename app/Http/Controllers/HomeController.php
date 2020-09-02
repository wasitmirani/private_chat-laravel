<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = DB::table('users')->get();
        global $active_users;
        foreach ($users as $user) {
            if (Cache::has('user-is-online-' . $user->id))
            $active_users[]=$user;


        }
        return view('home',compact(['active_users']));
    }

    public function userOnlineStatus()
    {
        $users = DB::table('users')->get();
        global $active_users;
        foreach ($users as $user) {
            if (Cache::has('user-is-online-' . $user->id))
            $active_users[]=$user;
            else
                echo "User " . $user->name . " is offline.";


        }
        return  dd( $active_users);
    }
}
