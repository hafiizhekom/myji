<?php

namespace App\Http\Controllers;

use App\Models\ProductDetail;
use App\Models\Production;
use App\Models\Purchasing;
use App\Models\OrderDetail;
 
class ReportController extends Controller
{
    public function production(){
        $result=$this->calc_production();

        
        return view( 
            'admin.report.production'
            ,['data'=>$result]
        ); 

    }

    public function production_estimation(){
        $stock = $this->calc_stock();
        
        foreach ($stock as $key => $value) {
            $stock[$key]['production_request'] = $this->calc_production_request_by_product($value['product_detail']->id);
            $stock[$key]['estimation_stock']=$value['stock']+$this->calc_production_request_by_product($value['product_detail']->id);
        }

        
        $data = [
            'stock' => $stock
        ];
        return view( 
            'admin.report.production_estimation'
            ,['data'=>$data]
        ); 

    }
    
    public function stock(){

        $result = $this->calc_stock();

        // dd($result);
        $data = [
            'stock' => $result
        ];
        return view( 
            'admin.report.stock'
            ,['data'=>$data]
        ); 
    }

    public function export_stock(){   
        return Excel::download(new InvoicesExport, 'invoices.xlsx');
    }

    private function calc_production_request_by_product($product_detail_id){
        $request = [];
        $request_stock = 0;
        $production = new Production();
        $production = $production
        ->where('product_detail_id', $product_detail_id)
        ->where(function ($query) {
            $query->where('actual',0)->orWhereNull('actual');
        })
        ->get();

       
        foreach ($production as $key2 => $value2) {
            $request_stock = $request_stock + $value2->request;
        }

        return $request_stock;
    }

    // array:9 [▼
    // 8 => array:2 [▼
    //     "po_code" => "PO-1"
    //     "request_stock" => 700
    // ]
    // 9 => array:2 [▼
    //     "po_code" => "PO-2"
    //     "request_stock" => 0
    // ]
    private function calc_production(){
        $data = [];
        $purchasing = new Purchasing();
        $purchasing = $purchasing->get();
        foreach ($purchasing as $key => $value) {
            $request_stock = 0;
            $actual_stock = 0;
            $production = new Production();
            $production = $production
            ->where('purchasing_id', $value->id)
            ->where(function ($query) {
                $query->where('actual',0)->orWhereNull('actual');
            })
            ->get();
            foreach ($production as $key2 => $value2) {
                $request_stock = $request_stock + $value2->request;
                $actual_stock = $actual_stock + $value2->actual;
            }
            $data[$value->id]['po_code']= $value->po_code;
            $data[$value->id]['request_stock']= $request_stock;
            $data[$value->id]['actual_stock']= $actual_stock;
        }

        return $data;
    }

    // array:8 [▼
    // 1 => array:11 [▼
    //     "product" => App\Models\ProductDetail {#1373 ▶}
    //     "actual" => 242
    //     "defect" => 1
    //     "sold" => 16
    //     "return_actual_minus" => 0
    //     "return_actual" => 0
    //     "refund_actual" => 0
    //     "return_defect" => 0
    //     "refund_defect" => 0
    //     "stockdefect" => 1
    //     "stock" => 225
    // ]
    // 2 => array:11 [▼
    //     "product" => App\Models\ProductDetail {#1374 ▶}
    //     "actual" => 0
    //     "defect" => 0
    //     "sold" => 23
    //     "return_actual_minus" => 0
    //     "return_actual" => 0
    //     "refund_actual" => 23
    //     "return_defect" => 0
    //     "refund_defect" => 0
    //     "stockdefect" => 0
    //     "stock" => 0
    // ]
    private function calc_stock(){
        $result = [];
        $product = ProductDetail::all();
        
        foreach ($product as $keyProduct => $valueProduct) {
            $result[$valueProduct->id]['product_detail'] = $valueProduct;
            
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

        return $result;
    }

}

