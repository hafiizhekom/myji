<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductDetail;
 
class OrderDetailController extends Controller
{
   
    public function index($id){

        $order = Order::where('id',$id)->first();
        $orderDetail = OrderDetail::where('order_id',$id)->get();
        $productDetail = ProductDetail::all();
        $data = [
            'order' => $order,
            'orderDetail' => $orderDetail,
            'productDetail' => $productDetail,
        ];
        return view(
            'admin.order_detail'
            ,['data'=>$data]
        );
    }

    public function add($id)
    {
    	$data = [
            'order_id'=>$id, 
            'product_detail_id'=>request('product_detail_id'),
            'quantity'=>request('quantity'),
            'price'=>request('price')
        ];
        $simpan = OrderDetail::create($data);
        return redirect()->route('order_detail', ['id'=>$id]);
    }

    public function edit($id, $iddetail)
    {
        
        $order = OrderDetail::findOrFail($iddetail);
        $data = [
            'order_id'=>$id, 
            'product_detail_id'=>request('product_detail_id'),
            'quantity'=>request('quantity'),
            'price'=>request('price')
        ];
        
        $order->update($data);
        return redirect()->route('order_detail', ['id'=>$id]);
    }


    public function delete($id, $iddetail, Request $request)
    {
        $order = OrderDetail::findOrFail($iddetail);
        $order->delete();

        return redirect()->route('order_detail', ['id'=>$id]);
    }
}

