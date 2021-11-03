<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductDetail;
use App\Models\Channel;
use App\Models\Customer;
 
class OrderController extends Controller
{
    public function index(){

        $orderAll = Order::where('type_order','standart')->get();
        $order = Order::all();
        $channel = Channel::all();
        $customer = Customer::all();
        $data = [
            'orderAll' => $orderAll,
            'order' => $order,
            'channel' => $channel,
            'customer' => $customer,
        ];
        return view(
            'admin.order'
            ,['data'=>$data]
        );
    }

    public function detail($id){

        
        $order = Order::where('id',$id)->first();
        $orderDetail = OrderDetail::where('order_id',$id)->get();
        $channel = Channel::all();
        $customer = Customer::all();
        $productDetail = ProductDetail::all();
        $data = [
            'order' => $order,
            'orderDetail' => $orderDetail,
            'channel' => $channel,
            'customer' => $customer,
            'productDetail' => $productDetail,
        ];
        return view(
            'admin.order_detail'
            ,['data'=>$data]
        );
    }

    public function add()
    {

        if(request('return')){
            $type_order = "return";
            $return_order = request('return_order');
        }else{
            $type_order = "standart";
            $return_order = 0;
        }
    	$data = [
            'channel_id'=>request('channel_id'), 
            'customer_id'=>request('customer_id'),
            'discount_amount'=>request('discount_amount'),
            'discount_percentage'=>request('discount_percentage'),
            'address_shipping'=>request('address_shipping'),
            'total_price'=>request('total_price'),
            'order_date'=>request('order_date'),
            'order_date'=>request('order_date'),
            'type_order'=>$type_order,
            'return_order'=>$return_order
        ];
        $simpan = Order::create($data);
        return redirect()->route('order');
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $data = [
            'channel_id'=>request('channel_id'), 
            'customer_id'=>request('customer_id'),
            'discount_amount'=>request('discount_amount'),
            'discount_percentage'=>request('discount_percentage'),
            'address_shipping'=>request('address_shipping'),
            'total_price'=>request('total_price'),
            'order_date'=>request('order_date'),
        ];
        
        $order->update($data);
        return redirect()->route('order');
    }


    public function delete($id, Request $request)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('order');
    }
}

