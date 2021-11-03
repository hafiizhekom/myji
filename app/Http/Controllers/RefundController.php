<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Refund;
use App\Models\OrderDetail;
 
class RefundController extends Controller
{
    public function index(){

        $refund = Refund::all();
        $orderDetail = OrderDetail::all();
        $data = [
            'refund' => $refund,
            'orderDetail' => $orderDetail
        ];
        return view(
            'admin.refund'
            ,['data'=>$data]
        );
    }

   

    public function add()
    {

        $orderDetail = OrderDetail::findOrFail(request('order_detail_id'));
        if(request('type')=="refund"){
            $data = [
                'status'=>'refunded',
            ];
        }elseif(request('type')=="return"){
            $data = [
                'status'=>'returned',
            ];
        }
        $orderDetail->update($data);

    	$dataRefund = [
            'order_detail_id'=>request('order_detail_id'), 
            'reason'=>request('reason'),
            'type'=>request('type'),
            'stock_flow'=>request('stock_flow')
        ];

        $simpan = Refund::create($dataRefund);
        return redirect()->route('order_detail', $orderDetail->order_id);
    }

    public function edit($id)
    {
        $refund = Refund::findOrFail($id);
        $data = [
            'reason'=>request('reason'),
        ];
        
        $refund->update($data);
        return redirect()->route('refund');
    }


    public function delete($id, Request $request)
    {
        $refund = Refund::findOrFail($id);
        $refund->delete();

        return redirect()->route('refund');
    }
}

