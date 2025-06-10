<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\order;
use Illuminate\Http\Request;

class orderController extends Controller
{
    public function allOrderList(){
        $orders = order:: with('orderdettails')->get();

        return view('Backend.order.allorderlist', compact('orders'));
    }
}
