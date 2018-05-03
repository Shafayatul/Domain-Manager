<?php

namespace App\Http\Controllers;

// use App\user;
use Illuminate\Http\Request;
// use Spatie\Permission\Models\Role;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //to be removed

        // $user = user::find(2);
        // $user->syncRoles('Admin');
        // var_dump($user->getRoleNames());


        return view('home');



    }
}
