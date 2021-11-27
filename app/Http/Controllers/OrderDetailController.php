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
        $productDetail = ProductDetail::orderBy('product_id','desc')->get();
        $price=[];
        foreach ($productDetail as $key => $value) {
            # code...
            $price[$value->id]=$value->price;
        }
        $data = [
            'order' => $order,
            'orderDetail' => $orderDetail,
            'productDetail' => $productDetail,
            'price' => $price
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
            'price'=>request('price'),
            'total_price'=>request('total_price'),
        ];
        $simpan = OrderDetail::create($data);
        $this->updateOrderTotalPrice($id);
        return redirect()->route('order_detail', ['id'=>$id]);
    }

    public function edit($id, $iddetail)
    {
        
        $order = OrderDetail::findOrFail($iddetail);
        $data = [
            'order_id'=>$id, 
            'product_detail_id'=>request('product_detail_id'),
            'quantity'=>request('quantity'),
            'price'=>request('price'),
            'total_price'=>request('total_price'),
        ];
        
        $order->update($data);
        $this->updateOrderTotalPrice($order->order_id);
        return redirect()->route('order_detail', ['id'=>$id]);
    }


    public function delete($id, $iddetail, Request $request)
    {
        $order = OrderDetail::findOrFail($iddetail);
        $order->delete();

        return redirect()->route('order_detail', ['id'=>$id]);
    }

    private function updateOrderTotalPrice($id){
        $order = Order::where('id', $id)->first();
        $newPrice = totalprice_order($order);

        $order = Order::find($id);
        $order->total_price = $newPrice;
        if($order->save()){
            return true;
        }else{
            return false;
        }

        
    }
}

