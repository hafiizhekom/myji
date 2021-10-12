<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Production;
use App\Models\Purchasing;
use App\Models\ProductDetail;
 
class ProductionDefectController extends Controller
{

    public function index(){

        $production = Production::whereNotNull('defect')->get();
        $production_request = Production::whereNull('defect')->whereNotNull('actual')->get();

        $data = [
            'production' => $production,
            'production_request' => $production_request
        ];
        return view(
            'admin.production.defect'
            ,['data'=>$data]
        );
    }

    public function search(){
        $id = request('id');

        $production = Production::whereNotNull('defect')->where('id',$id)->get();
        $production_request = Production::whereNull('defect')->whereNotNull('actual')->get();
        
        $data = [
            'production' => $production,
            'production_request' => $production_request
        ];
        return view(
            'admin.production.defect_search'
            ,['data'=>$data]
        );
    }

    public function add()
    {
        $cabang = Production::findOrFail(request('production_id'));
    	$data = [
            'defect'=>request('defect')
        ];
        $cabang->update($data);
        return redirect()->route('production.defect');
    }

    public function edit($id)
    {
        $cabang = Production::findOrFail($id);
        $data = [
            'defect'=>request('defect')
        ];
        
        $cabang->update($data);
        return redirect()->route('production.defect');
    }


    public function delete($id, Request $request)
    {
        $cabang = Production::findOrFail($id);
        $cabang->delete();

        return redirect()->route('production');
    }
}

