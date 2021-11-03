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

    public function search(){
        $po_code = request('po_code');

        $purchasing = Purchasing::where('po_code',$po_code)->first();

        $production = Production::where('purchasing_id',$purchasing->id)->get();
            
        $productExclude = [];
        foreach($production as $item){
            array_push($productExclude, $item->product_detail_id);
        }
        

        $product_detail = ProductDetail::whereNotIn('id', $productExclude)->get();

        $data = [
            'production' => $production,
            'purchasing' => $purchasing,
            'product_detail' => $product_detail
        ];
        return view(
            'admin.production.request_search'
            ,['data'=>$data]
        );
    }

    public function append()
    {
        $data = [
            'purchasing_id'=>request('purchasing_id'), 
            'product_detail_id'=>request('product_detail_id'),
            'request'=>request('request')
        ];
        $simpan = Production::create($data);

        $purchasing = Purchasing::where('id', request('purchasing_id'))->first();
 	
        return redirect()->route('production.request.search', ['po_code'=>$purchasing->po_code]);
    }

    public function add()
    {

        foreach(request('product_detail_id') as $key=>$value){
            $data = [
                'purchasing_id'=>request('purchasing_id'), 
                'product_detail_id'=>$value,
                'request'=>request('request-'.$value)
            ];
            $simpan = Production::create($data);
        }

        $purchasing = Purchasing::where('id', request('purchasing_id'))->first();
 	
        return redirect()->route('production.request.search', ['po_code'=>$purchasing->po_code]);
    }

    public function edit($id)
    {
        $production = Production::findOrFail($id);
        $data = [
            'request'=>request('request')
        ];
        
        $production->update($data);
        return redirect()->route('production.request.search',['po_code'=>$production->purchasing->po_code]);
    }


    public function delete($id, Request $request)
    {
        $cabang = Production::findOrFail($id);
        $cabang->delete();

        return redirect()->route('production.request');
    }
}

