<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promo;
use App\Models\PromoDetail;
use App\Models\ProductDetail;
 
class PromoDetailController extends Controller
{
   
    public function index($id){

        $promo = Promo::where('id',$id)->first();
        $promoDetail = PromoDetail::where('promo_id',$id)->get();
        $productDetail = ProductDetail::all();
        $data = [
            'promo' => $promo,
            'promoDetail' => $promoDetail,
            'productDetail' => $productDetail,
        ];
        return view(
            'admin.promo_detail'
            ,['data'=>$data]
        );
    }

    public function add($id)
    {
    	$data = [
            'promo_id'=>$id, 
            'product_detail_id'=>request('product_detail_id')
        ];
        $simpan = PromoDetail::create($data);
        return redirect()->route('promo_detail', ['id'=>$id]);
    }

    public function edit($id, $iddetail)
    {
        
        $promo = PromoDetail::findOrFail($iddetail);
        $data = [
            'promo_id'=>$id, 
            'product_detail_id'=>request('product_detail_id')
        ];
        
        $promo->update($data);
        return redirect()->route('promo_detail', ['id'=>$id]);
    }


    public function delete($id, $iddetail, Request $request)
    {
        $promo = PromoDetail::findOrFail($iddetail);
        $promo->delete();

        return redirect()->route('promo_detail', ['id'=>$id]);
    }
}

