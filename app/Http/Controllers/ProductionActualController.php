<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Production;
use App\Models\Purchasing;
use App\Models\ProductDetail; 
 
class ProductionActualController extends Controller 
{

    public function index(){ 

        $production = Production::all()->unique('purchasing_id');
        $production_request = Production::whereNull('actual')->get()->unique('purchasing_id');
        
        $data = [
            'production' => $production,
            'production_request' => $production_request 
        ];
        return view(
            'admin.production.actual'
            ,['data'=>$data]
        );
    }

    public function search(){
        $po_code = request('po_code');

        $purchasing = Purchasing::where('po_code',$po_code)->first();
        
        $production = Production::where('purchasing_id',$purchasing->id)->get();
        
        $data = [
            'production' => $production,
            'purchasing' => $purchasing
        ];
        return view(
            'admin.production.actual_search'
            ,['data'=>$data]
        );
    }


    public function edit($id)
    {
        
        $production = Production::findOrFail($id);
        $data = [
            'actual'=>request('actual')
        ];
        
        $production->update($data);

        
        return redirect()->route('production.actual.search',  ['po_code'=>$production->purchasing->po_code]);
    }


    public function delete($id, Request $request)
    {
        
        $production = Production::findOrFail($id);

        
        $data = [
            'actual'=> null
        ];
        $production->update($data);


        return redirect()->route('production.actual.search',  ['po_code'=>$production->purchasing->po_code]);
    }
}

