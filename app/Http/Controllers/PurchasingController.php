<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchasing;
use App\Models\Production;
 
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

        $purchasing = new Purchasing();
        if($month || $month!=0){
            $purchasing = $purchasing->whereMonth('order_date', '=', $month);
        }

        if($year || $year!=0){
            $purchasing = $purchasing->whereYear('order_date', '=', $year);
        }
        
        
        $purchasing = $purchasing->get();

        foreach ($purchasing as $key => $value) {
            
            foreach (Production::where('purchasing_id', $value->id)->get() as $keysec => $valuesec) {
                if(!$valuesec->actual_complete){
                    $value->flag_complete = 0;
                    break;
                }

                $value->flag_complete = 1;
            }
        }

        
        $data = [
            'purchasing' => $purchasing,
            'month' => $month,
            'year' => $year, 
        ];
        return view(
            'admin.production.purchasing_search'
            ,['data'=>$data]
        );
    }

    public function add(Request $request)
    {
        $month = request('month');
        $year = request('year');
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
            'estimation_date'=>request('estimation_date')
            
        ];
        $simpan = Purchasing::create($data);
        return redirect()->route('production.purchasing.search', ['month'=>$month, 'year'=>$year ]);
    }

    public function edit(Request $request, $id)
    {
        $month = request('month');
        $year = request('year');
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
        return redirect()->route('production.purchasing.search', ['month'=>$month, 'year'=>$year ]);
    }


    public function delete($id, Request $request)
    {
        $month = request('month');
        $year = request('year');
        $cabang = Purchasing::findOrFail($id);
        $cabang->delete();

        return redirect()->route('production.purchasing.search', ['month'=>$month, 'year'=>$year ]);
    }
}

