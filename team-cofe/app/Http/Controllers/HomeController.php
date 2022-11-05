<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view("home");
    }


    public function redirects()
    {
        $usertype = Auth::user()->usertype;

        if($usertype == '')
        {
            return view('admin.adminhome');
        }

        else
        {
            return view('home');
        }
    }
}