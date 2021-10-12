<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchasing;
 
class PurchasingController extends Controller
{
    public function index(){

        $purchasing = Purchasing::all();
        $data = [
            'purchasing' => $purchasing
        ];
        return view(
            'admin.purchasing'
            ,['data'=>$data]
        );
    }

    public function add()
    {
    	$data = [
            'po_code'=>request('po_code'), 
            'item'=>request('item'),
            'unit'=>request('unit'),
            'unit_price'=>request('unit_price'),
            'shipping_cost'=>request('shipping_cost'),
            'discount_amount'=>request('discount_amount'),
            'discount_percentage'=>request('discount_percentage'),
            'total_price'=>request('total_price'),
            'total_price_with_shipping'=>request('total_price_with_shipping'),
            
        ];
        $simpan = Purchasing::create($data);
        return redirect()->route('purchasing');
    }

    public function edit($id)
    {
        $cabang = Purchasing::findOrFail($id);
        $data = [
            'po_code'=>request('po_code'), 
            'item'=>request('item'),
            'unit'=>request('unit'),
            'unit_price'=>request('unit_price'),
            'shipping_cost'=>request('shipping_cost'),
            'discount_amount'=>request('discount_amount'),
            'discount_percentage'=>request('discount_percentage'),
            'total_price'=>request('total_price'),
            'total_price_with_shipping'=>request('total_price_with_shipping')
        ];
        
        $cabang->update($data);
        return redirect()->route('purchasing');
    }


    public function delete($id, Request $request)
    {
        $cabang = Purchasing::findOrFail($id);
        $cabang->delete();

        return redirect()->route('purchasing');
    }
}

