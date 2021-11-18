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
            'production.request' => $production_request 
        ];
        return view(
            'admin.production.actual'
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
            $production = $production->whereMonth('actual_date', '=', $month);
        }

        if($year || $year!=0){
            $production = $production->whereYear('actual_date', '=', $year);
        }
        $production = $production->get();
        
        $data = [
            'production' => $production,
            'purchasing' => $purchasing,
            'period' => $period,
            'month' => $month,
            'year' => $year,
        ];
        return view(
            'admin.production.actual_search'
            ,['data'=>$data]
        );
    }


    public function edit($id)
    {
        $month = request('month');
        $year = request('year'); 
        
        $production = Production::findOrFail($id);
        $data = [
            'actual'=>request('actual'),
        ];
        
        $production->update($data);

        
        return redirect()->route('production.actual.search',  ['po_code'=>$production->purchasing->po_code, 'month'=>$month, 'year'=>$year]);
    }


    public function delete($id, Request $request)
    {
        $month = request('month');
        $year = request('year'); 
        $production = Production::findOrFail($id);

        
        $data = [
            'actual'=> null
        ];
        $production->update($data);


        return redirect()->route('production.actual.search',  ['po_code'=>$production->purchasing->po_code, 'month'=>$month, 'year'=>$year]);
    }

    public function complete($id, Request $request)
    {
        $month = request('month');
        $year = request('year'); 
        $production = Production::findOrFail($id);
        
        
        $data = [
            'actual_complete'=> true
        ];
        $production->update($data);

        return redirect()->route('production.actual.search',  ['po_code'=>$production->purchasing->po_code, 'month'=>$month, 'year'=>$year]);
    }
}

