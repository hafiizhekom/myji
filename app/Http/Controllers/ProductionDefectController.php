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
            $production = $production->whereMonth('defect_date', '=', $month);
        }

        if($year || $year!=0){
            $production = $production->whereYear('defect_date', '=', $year);
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
            'admin.production.defect_search'
            ,['data'=>$data]
        );
    }

    public function edit($id)
    {
        $month = request('month');
        $year = request('year');
        $production = Production::findOrFail($id);
        $data = [
            'defect'=>request('defect'),
            'reason_defect'=>request('reason_defect')
        ];
        
        $production->update($data);
        
        return redirect()->route('production.defect.search',  ['po_code'=>$production->purchasing->po_code, 'month'=>$month, 'year'=>$year]);
    }


    public function delete($id, Request $request)
    {
        $month = request('month');
        $year = request('year');
        $production = Production::findOrFail($id);
        $data = [
            'defect'=> null
        ];
        $production->update($data);

        return redirect()->route('production.defect.search',  ['po_code'=>$production->purchasing->po_code, 'month'=>$month, 'year'=>$year]);
    }
}

