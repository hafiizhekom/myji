<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Models\Production;
use App\Models\OrderDetail;
 
class ReportController extends Controller
{
    public function stock(){

        $result = [];
        $product = ProductDetail::all();
        
        foreach ($product as $keyProduct => $valueProduct) {
            $result[$valueProduct->id]['product'] = $valueProduct;
            
            $stock = 0;
            $stockdefect = 0;
            $production = Production::where('product_detail_id', $valueProduct->id)->get();
            $actual = 0;
            $defect = 0;

            //MENGHITUNG SELURUH PRODUCTION ACTUAL DAN JUGA DEFECT
            foreach ($production as $keyProduction => $valueProduction) {
                $actual = $actual + $valueProduction->actual;
                $defect = $defect + $valueProduction->defect;
            }
            $result[$valueProduct->id]['actual'] = $actual;
            $result[$valueProduct->id]['defect'] = $defect;
            $stock = $actual - $defect;
            $stockdefect = $stockdefect + $defect;

            //DIKURANGI DARI SELURUH ORDER
            $orderDetail = OrderDetail::where('product_detail_id', $valueProduct->id)->get();
            $quantity = 0;
            foreach ($orderDetail as $keyOrderDetail => $valueOrderDetail) {
                $quantity = $quantity + $valueOrderDetail->quantity;
            }
            $result[$valueProduct->id]['sold'] = $quantity;
            $stock = $stock - $quantity;

            
            
            

            //MENGHITUNG STOCK DARI RETURN/REFUND
            $refund_actual = 0;
            $refund_defect = 0;
            
            $return_actual = 0;
            $return_defect = 0;
            $orderDetailRefunded = OrderDetail::where('product_detail_id', $valueProduct->id)
            ->where(function ($query) {
                $query->where('status', '=', 'refunded')
                      ->orWhere('status', '=', 'returned');
            })
            ->get();
            foreach ($orderDetailRefunded as $keyOrderDetailRefunded => $valueOrderDetailRefunded) {
                
                if($valueOrderDetailRefunded->refund->type=="return"){
                    //STOCK ACTUAL -1 LAGI

                    // $return_actual_minus = $return_actual_minus + $valueOrderDetailRefunded->quantity;

                    if($valueOrderDetailRefunded->refund->stock_flow=="actual"){
                        $return_actual = $return_actual + $valueOrderDetailRefunded->quantity;
                    }elseif($valueOrderDetailRefunded->refund->stock_flow=="defect"){
                        $return_defect = $return_defect + $valueOrderDetailRefunded->quantity;
                    }
                }elseif($valueOrderDetailRefunded->refund->type=="refund"){
                    //STOCK ACTUAL TETAP
                    if($valueOrderDetailRefunded->refund->stock_flow=="actual"){
                        $refund_actual = $refund_actual + $valueOrderDetailRefunded->quantity;
                    }elseif($valueOrderDetailRefunded->refund->stock_flow=="defect"){
                        $refund_defect = $refund_defect + $valueOrderDetailRefunded->quantity;
                    }
                }
            }

            $return_actual_minus = 0;
            $orderDetailOutcomingReturn = OrderDetail::where('product_detail_id', $valueProduct->id)->get();
            foreach ($orderDetailOutcomingReturn as $keyOrderDetailOutcomingReturn => $valueOrderDetailOutcomingReturn) {
                if($valueOrderDetailOutcomingReturn->order->type_order=="return"){
                    $return_actual_minus = $return_actual_minus + $valueOrderDetailOutcomingReturn->quantity;
                }
            }
            
            $stock = $stock - $return_actual_minus;
            $stock = $stock + $return_actual;
            $stock = $stock + $refund_actual;

            $stockdefect = $stockdefect + $return_defect;
            $stockdefect = $stockdefect + $refund_defect;


            

            $result[$valueProduct->id]['return_actual_minus'] = $return_actual_minus;
            $result[$valueProduct->id]['return_actual'] = $return_actual;
            $result[$valueProduct->id]['refund_actual'] = $refund_actual;
            $result[$valueProduct->id]['return_defect'] = $return_defect;
            $result[$valueProduct->id]['refund_defect'] = $refund_defect;

            $result[$valueProduct->id]['stockdefect'] = $stockdefect;
            $result[$valueProduct->id]['stock'] = $stock;
            
            
    
        }

        // dd($result);
        $data = [
            'stock' => $result
        ];
        return view( 
            'admin.report.stock'
            ,['data'=>$data]
        ); 
    }


    public function stock_flow($id){

        $result = [];
        $product = ProductDetail::where('id', $id)->first();
        $production = Production::where('product_detail_id', $product->id)->get();
        foreach ($production as $keyProduction => $valueProduction) {
            # code...
        }


    }


    public function add()
    {
    	$data = [
            'color_name'=>request('color_name'), 
            'color_code'=>request('color_code')
        ];
        $simpan = Color::create($data);
        return redirect()->route('color');
    }

    public function edit($id)
    {
        $cabang = Color::findOrFail($id);
       	$data = [ 
            'color_name'=>request('color_name'), 
            'color_code'=>request('color_code')
        ];
        
        $cabang->update($data);
        return redirect()->route('color');
    }


    public function delete($id, Request $request)
    {
        $cabang = Color::findOrFail($id);
        $cabang->delete();

        return redirect()->route('color');
    }
}

