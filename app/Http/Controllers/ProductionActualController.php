<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Production;
use App\Models\Purchasing;
use App\Models\ProductDetail;
 
class ProductionActualController extends Controller 
{

    public function index(){ 

        $production = Production::whereNotNull('actual')->get()->unique('purchasing_id');
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

    public function detail($id){ 

        $production = Production::where('purchasing_id', $id)->get();
        
        $data = [
            'production' => $production,
            // 'production_request' => $production_request
        ];
        return view(
            'admin.production.actual_detail'
            ,['data'=>$data]
        );
    }

    public function search(){
        $po_code = request('po_code');

        $purchasing = Purchasing::where('po_code',$po_code)->first();
        
        $production = Production::whereNotNull('actual')->where('purchasing_id',$purchasing->id)->get();
        $production_request = Production::whereNull('actual')->get();
        
        $data = [
            'production' => $production,
            'production_request' => $production_request
        ];
        return view(
            'admin.production.actual_search'
            ,['data'=>$data]
        );
    }

    public function add()
    {

        foreach(request('production_id') as $key => $value){
            $cabang = Production::findOrFail($value);
            $data = [
                'actual'=>request('actual-'.$value)
            ];
            $cabang->update($data);
        }

        
        $purchasing = Purchasing::where('id', request('purchasing_id'))->first();

        
        return redirect()->route('production.actual.search',  ['po_code'=>$purchasing->po_code]);
    }

    public function edit($id)
    {
        $cabang = Production::findOrFail($id);
        $data = [
            'actual'=>request('actual')
        ];
        
        $cabang->update($data);
        return redirect()->route('production.actual');
    }


    public function delete($id, Request $request)
    {
        $cabang = Production::findOrFail($id);
        $cabang->delete();

        return redirect()->route('production');
    }
}

