<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Endorse;
use App\Models\EndorseDetail;
use App\Models\ProductDetail;
 
class EndorseDetailController extends Controller
{
   
    public function index($id){

        $endorse = Endorse::where('id',$id)->first();
        $endorseDetail = EndorseDetail::where('endorse_id',$id)->get();
        $productDetail = ProductDetail::all();
        $data = [
            'endorse' => $endorse,
            'endorseDetail' => $endorseDetail,
            'productDetail' => $productDetail,
        ];
        return view(
            'admin.endorse_detail'
            ,['data'=>$data]
        );
    }

    public function add($id)
    {
    	$data = [
            'endorse_id'=>$id, 
            'product_detail_id'=>request('product_detail_id'),
            'quantity'=>request('quantity'),
        ];
        $simpan = EndorseDetail::create($data);
        return redirect()->route('endorse_detail', ['id'=>$id]);
    }

    public function edit($id, $iddetail)
    {
        
        $endorse = EndorseDetail::findOrFail($iddetail);
        $data = [
            'endorse_id'=>$id, 
            'product_detail_id'=>request('product_detail_id'),
            'quantity'=>request('quantity'),
        ];
        
        $endorse->update($data);
        return redirect()->route('endorse_detail', ['id'=>$id]);
    }


    public function delete($id, $iddetail, Request $request)
    {
        $endorse = EndorseDetail::findOrFail($iddetail);
        $endorse->delete();

        return redirect()->route('endorse_detail', ['id'=>$id]);
    }
}

