<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promo;
use App\Models\PromoDetail;
 
class PromoController extends Controller
{
    public function index(){

        $promo = Promo::all();
        foreach ($promo as $key => $value) {
            $value->promo_date = str_replace("-","/",$value->start_time)." - ".  str_replace("-","/",$value->end_time);
        }

        
        
        $data = [
            'promo' => $promo
        ];
        return view(
            'admin.promo'
            ,['data'=>$data]
        );
    }

    public function add()
    {

        $promo_date = request('promo_date');
        $promo_date = explode("-", $promo_date);
        
    	$data = [
            'promo_name'=>request('promo_name'), 
            'promo_code'=>request('promo_code'),
            'fixed_amount'=>request('fixed_amount'),
            'percentage_amount'=>request('percentage_amount'),
            'start_time'=>$promo_date[0],
            'end_time'=>$promo_date[1],
            'active'=>request('active')
        ];

        $simpan = Promo::create($data);
        return redirect()->route('promo');
    }

    public function edit($id)
    {
        $promo_date = request('promo_date');
        $promo_date = explode("-", $promo_date);

        $promo = Promo::findOrFail($id);
       	$data = [ 
            'promo_name'=>request('promo_name'), 
            'promo_code'=>request('promo_code'),
            'fixed_amount'=>request('fixed_amount'),
            'percentage_amount'=>request('percentage_amount'),
            'start_time'=>$promo_date[0],
            'end_time'=>$promo_date[1],
            'active'=>request('active')
        ];
        
        $promo->update($data);
        return redirect()->route('promo');
    }


    public function delete($id, Request $request)
    {
        $promo = Promo::findOrFail($id);
        $promo->delete();
        $promoDetail = PromoDetail::where('promo_id', $id)->delete();
        
        
        return redirect()->route('promo');
    }
}

