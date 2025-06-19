<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

        if($status == "delivered"){
            if($order->courier_name == "Steadfast"){

                // API Endpoint
                $endpoint = "https://portal.packzy.com/api/v1/create_order";

                // Auth Parametres....
                $apiKey = "mafgr0eupg757qtxsniloqg862nzffvu";
                $secreateKey = "2yuj5qrvt5pawyaxvm0ivibb";
                $contentType = "application/json";

                //The Body Parametres...
                $invoiceId = $order->invoiceId;
                $customerName = $order->c_name;
                $customerPhone = $order->c_phone;
                $customerAddress = $order->address;
                $orderPrice = $order->price;

                //The Header...
                $header = [
                    'Api-Key' => $apiKey,
                    'Secret-Key' => $secreateKey,
                    'Content-Type' => $contentType,
                ];

                //The Payload...
                $payload = [
                   'invoice' => $invoiceId,
                   'recipient_name' => $customerName,
                   'recipient_phone' => $customerPhone,
                   'recipient_address' => $customerAddress,
                   'cod_amount' => $orderPrice,

                ];

                $response = Http::withHeaders($header)->post($endpoint,$payload);

                $responseData = $response->json();
                // dd($responseData);


            }

            else{
                return "Select Courier";
            }
        }

          $order->save();
        return redirect()->back();
    }

    public function statusWiseOrder($status)
    {
        $orders = order::where('status',$status)->with('orderdettails')->get();
        return view('Backend.order.status-wise-order-list',compact('orders'));
    }

}
