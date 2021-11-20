<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Production;
use App\Models\Purchasing;
use App\Models\ProductDetail;
 
class ProductionRequestController extends Controller
{
    public function index(){ 

        $production = Production::all()->unique('purchasing_id');

        $purchasing = Purchasing::all();
        $purchasing_avail = [];
        foreach($purchasing as $item){
            if(!$item->production){
                array_push($purchasing_avail, $item->po_code);
            }
        }
        $purchasing = Purchasing::whereIn('po_code',$purchasing_avail)->get();

        $product_detail = ProductDetail::all();

        $data = [
            'production' => $production,
            'purchasing' => $purchasing,
            'product_detail' => $product_detail
        ];
        return view(
            'admin.production.request'
            ,['data'=>$data]
        );
    }

    public function search(Request $request){
        $po_code = request('po_code');
        $month = request('month');
        $year = request('year'); 
        
        if(($month || $month!=0) && ($year || $year!=0)){
            $period = date("F Y", strtotime($year."-".$month."-01"));
        }else if($month || $month!=0){
            $period = date("F", strtotime("2021-".$month."-01"));
        }else if($year || $year!=0){
            $period = date("Y", strtotime($year."-01-01"));
        }else{
            $period = "All Time";
        }
        

        $purchasing = Purchasing::where('po_code',$po_code)->first();

        $production = Production::where('purchasing_id',$purchasing->id);
        if($month || $month!=0){
            $production = $production->whereMonth('request_date', '=', $month);
        }

        if($year || $year!=0){
            $production = $production->whereYear('request_date', '=', $year);
        }
        $production = $production->get();
            
        $productExclude = [];
        foreach($production as $item){
            array_push($productExclude, $item->product_detail_id);
        }
        

        $product_detail = ProductDetail::whereNotIn('id', $productExclude)->get();
        
        $data = [
            'production' => $production,
            'purchasing' => $purchasing,
            'product_detail' => $product_detail,
            'period' => $period,
            'month' => $month,
            'year' => $year,
        ];
        return view(
            'admin.production.request_search'
            ,['data'=>$data]
        );
    }

    public function append(Request $request)
    {
        $month = request('month');
        $year = request('year');
        
        $data = [
            'purchasing_id'=>request('purchasing_id'), 
            'product_detail_id'=>request('product_detail_id'),
            'request'=>request('request'),
            'request_date'=>request('request_date')
        ];
        $simpan = Production::create($data);

        $purchasing = Purchasing::where('id', request('purchasing_id'))->first();
 	
        // return redirect()->route('production.request.search', ['po_code'=>$purchasing->po_code, 'month'=>date('n'), 'year'=>date('Y') ]);
        return redirect()->route('production.request.search', ['po_code'=>$purchasing->po_code, 'month'=>$month, 'year'=>$year ]);
    }

    public function add()
    {

        $month = date('n', strtotime(request('request_date')));
        $year = date('Y', strtotime(request('request_date')));

        foreach(request('product_detail_id') as $key=>$value){
            $data = [
                'purchasing_id'=>request('purchasing_id'), 
                'product_detail_id'=>$value,
                'request'=>request('request-'.$value),
                'request_date'=>request('request_date'), 
            ];
            $simpan = Production::create($data);
        }

        $purchasing = Purchasing::where('id', request('purchasing_id'))->first();
 	
        return redirect()->route('production.request.search', ['po_code'=>$purchasing->po_code, 'month'=>$month, 'year'=>$year ]);
    }

    public function edit(Request $request, $id)
    {
        
        $month = request('month');
        $year = request('year');
        $production = Production::findOrFail($id);
        $data = [
            'request'=>request('request'),
            'request_date'=>request('request_date')
        ];
        
        $production->update($data);
        return redirect()->route('production.request.search',['po_code'=>$production->purchasing->po_code, 'month'=>$month, 'year'=>$year ]);
    }


    public function delete($id, Request $request)
    {
        $month = request('month');
        $year = request('year');
        $production = Production::findOrFail($id);
        $production->delete();

        return redirect()->route('production.request.search',['po_code'=>$production->purchasing->po_code, 'month'=>$month, 'year'=>$year ]);
    }
}

