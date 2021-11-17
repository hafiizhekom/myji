<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchasing;
 
class PurchasingController extends Controller
{
    public function index(){

        return view(
            'admin.production.purchasing'
        );

        
    }

    public function search(Request $request){
        
        
        $month = request('month');
        $year = request('year');

        $request->session()->flash('month', $month);
        $request->session()->flash('year', $year);
        $purchasing = Purchasing::
        whereMonth('order_date', '=', $month)->
        whereYear('order_date', '=', $year)->
        get();

        
        $data = [
            'purchasing' => $purchasing
        ];
        return view(
            'admin.production.purchasing_search'
            ,['data'=>$data]
        );
    }

    public function add(Request $request)
    {
    	$data = [
            'po_code'=>request('po_code'),
            'supplier_name'=>request('supplier_name'), 
            'item'=>request('item'),
            'unit'=>request('unit'),
            'unit_price'=>request('unit_price'),
            'shipping_cost'=>request('shipping_cost'),
            'discount_amount'=>request('discount_amount'),
            'discount_percentage'=>request('discount_percentage'),
            'total_price'=>request('total_price'),
            'total_price_with_shipping'=>request('total_price_with_shipping'),
            'order_date'=>request('order_date'), 
            'estimation_date'=>request('estimation_date'), 
            
        ];
        $simpan = Purchasing::create($data);
        return redirect()->route('production.purchasing.search', ['month'=>$request->session()->get('month'), 'year'=>$request->session()->get('year') ]);
    }

    public function edit(Request $request, $id)
    {
        $cabang = Purchasing::findOrFail($id);
        $data = [
            'po_code'=>request('po_code'), 
            'supplier_name'=>request('supplier_name'),
            'item'=>request('item'),
            'unit'=>request('unit'),
            'unit_price'=>request('unit_price'),
            'shipping_cost'=>request('shipping_cost'),
            'discount_amount'=>request('discount_amount'),
            'discount_percentage'=>request('discount_percentage'),
            'total_price'=>request('total_price'),
            'total_price_with_shipping'=>request('total_price_with_shipping'),
            'order_date'=>request('order_date'), 
            'estimation_date'=>request('estimation_date'), 
        ];
        
        $cabang->update($data);
        return redirect()->route('production.purchasing.search', ['month'=>$request->session()->get('month'), 'year'=>$request->session()->get('year') ]);
    }


    public function delete($id, Request $request)
    {
        $cabang = Purchasing::findOrFail($id);
        $cabang->delete();

        return redirect()->route('purchasing');
    }
}

