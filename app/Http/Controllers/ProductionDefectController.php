<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Production;
use App\Models\Purchasing;
use App\Models\ProductDetail;
 
class ProductionDefectController extends Controller
{

    public function index(){

        $production = Production::all()->unique('purchasing_id');
        $production_request = Production::whereNull('defect')->whereNotNull('actual')->get();

        $data = [
            'production' => $production,
            'production.request' => $production_request
        ];
        return view(
            'admin.production.defect'
            ,['data'=>$data]
        );
    }

    public function search(){
        $po_code = request('po_code');

        $purchasing = Purchasing::where('po_code',$po_code)->first();
        
        $production = Production::whereNotNull('actual')->where('purchasing_id',$purchasing->id)->get();

        $data = [
            'production' => $production,
            'purchasing' => $purchasing
        ];
        return view(
            'admin.production.defect_search'
            ,['data'=>$data]
        );
    }

    public function edit($id)
    {
        $production = Production::findOrFail($id);
        $data = [
            'defect'=>request('defect')
        ];
        
        $production->update($data);
        
        return redirect()->route('production.defect.search',  ['po_code'=>$production->purchasing->po_code]);
    }


    public function delete($id, Request $request)
    {
        $production = Production::findOrFail($id);
        $data = [
            'defect'=> null
        ];
        $production->update($data);

        return redirect()->route('production.defect.search',  ['po_code'=>$production->purchasing->po_code]);
    }
}

