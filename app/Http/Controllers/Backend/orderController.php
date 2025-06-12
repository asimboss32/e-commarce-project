<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\order;
use Illuminate\Http\Request;

use function Symfony\Component\String\b;

class orderController extends Controller
{
    public function allOrderList(){
        $orders = order:: with('orderdettails')->get();

        return view('Backend.order.allorderlist', compact('orders'));
    }

    public function orderEdite ($id)
    {
        $order = order:: with('orderdettails')->where('id',$id)->first();
        return view ('Backend.order.order-edite',compact('order'));

    }

    public function orderUpdate(Request $request,$id)
    {
        $order = order::find($id);


        $order->c_name = $request->c_name;
        $order->c_phone = $request->c_phone;
        $order->address = $request->address;
        $order->area = $request->area;
        $order->courier_name = $request->courier_name;
        $order->price = $request->price;

         $order->save();
        return redirect()->back();

    }

    public function orderUpdateStatus($status, $id)
    {
        $order = order::find($id);
        $order->status = $status;

          $order->save();
        return redirect()->back();
    }

}
