<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class frontendcontroller extends Controller
{
    public function index()
    {
        return view ('index');
    }
    public function shop()
    {
        return view ('shop');
    }

}