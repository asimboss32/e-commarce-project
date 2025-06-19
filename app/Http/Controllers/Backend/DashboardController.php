<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function admindashboard()
  {
    

    $totalOrders = order::count();
    $pendingOrders =order::where('status','pending')->count();
    $confirmedOrders =order::where('status','confirmed')->count();
    $deliveredOrders =order::where('status','delivered')->count();
    $cancelledOrders =order::where('status','cancelled')->count();


   return view('Backend.Dashboard',compact('totalOrders','pendingOrders','confirmedOrders','deliveredOrders','cancelledOrders'));
  }
}
