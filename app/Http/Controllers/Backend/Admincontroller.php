<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admincontroller extends Controller
{
    public function adminlogin()
    {
        return view('auth.login');
    
    }
    public function adminlogout()
    {
       Auth::logout();
       return redirect('/admin/login');
    
    }
}
