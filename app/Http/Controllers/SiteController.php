<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Testimony;
use App\Models\Color;
use App\Models\Size;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Feedback;
use App\Models\FeedbackIdea;
use App\Models\PromoDetail;
use App\Models\Production;
use App\Models\OrderDetail;
use App\Models\EndorseDetail;
use App\Models\SettingMostWanted;
use App\Models\SettingSuggestion;
use Session;
 
class SiteController extends Controller
{
    public function index(){

        $slider = Slider::orderBy('order', 'ASC')->get();
        $settingMostWanted = SettingMostWanted::all();
        if($settingMostWanted->count()){
            $productMostWanted = array();
            foreach ($settingMostWanted as $key => $value) {
                # code...
                array_push($productMostWanted, $value->product->id);
            }
            $mostWanted = Product::has('detail')->with('detail')->whereIn('id', $productMostWanted)->orderBy('view','DESC')->limit(5)->get();
        }else{
            $mostWanted = Product::has('detail')->with('detail')->orderBy('view','DESC')->limit(5)->get();
        }
        

        // dd(json_encode($mostWanted));
        $testimonies = Testimony::all();
        $data = [
            'slider' => $slider,
            'mostWanted' =>$mostWanted,
            'testimonies' => $testimonies
        ];
        return view(
            'site.index'
            ,['data'=>$data]
        );
    }

    public function catalogue(
        Request $r
        ){
        $colorParam = $r->color;
        $categoryParam = $r->category;
        
        if($colorParam!=null){
            $colorParam = explode(',',$colorParam);
        }else{
            $colorParam = [];
        }
        
        
        if($categoryParam!=null){
            $categoryParam = explode(",",$categoryParam);
        }else{
            $categoryParam = [];
        }

        $color = Color::all();
        $category = Category::all();

        $product = Product::has('detail')->orderBy('created_at', 'DESC');
            
        
        if(count($colorParam)){
            $product = $product->whereHas('color', function($q) use($colorParam){
                $q->whereIn('color_code', $colorParam);
            });  
        }

        if(count($categoryParam)){
            $product = $product->whereHas('category', function($q) use($categoryParam){
                $q->whereIn('category_code', $categoryParam);
            });  
        }

        
        $product = $product->paginate(9);
        
        $data = [
            'color' => $color,
            'colorParam'=>$colorParam,
            'categoryParam'=>$categoryParam,
            'category' => $category,
            'product' => $product
        ];
        
        return view(
            'site.catalogue'
            ,['data'=>$data]
        );
    }

    public function product($id){

        $product = Product::where('id',$id)->has('detail')->with('detail')->first();

        foreach ($product->detail as $key => $value) {
            # code...
            $value->stock = $this->calc_stock($value->id);
        }

        $promoDetail = PromoDetail::where('product_detail_id',$id)->get();

        $settingSuggestion = SettingSuggestion::all();
        
        if($settingSuggestion->count()){
            $productSuggestion = array();
            foreach ($settingSuggestion as $key => $value) {
                # code...
                array_push($productSuggestion, $value->product_id);
            }
            
            $relateProducts = Product::where('id','<>', $id)->has('detail')->whereIn('id', $productSuggestion)->limit(5)->get();
            
        }else{
            $relateProducts = Product::where('id','<>', $id)->has('detail')->limit(5)->get();
            
        }

        
        $data = [
            'relateProducts' => $relateProducts,
            'product' => $product,
            'promoDetail' => $promoDetail,
        ];
        return view(
            'site.product'
            ,['data'=>$data]
        );
    }

    public function productDetail(Request $r, $id){
        
        
        
        $productDetail = ProductDetail::where('id',$id)->first();

        $productCounter = Product::findOrFail($productDetail->product_id);
        $productCounter->view = $productCounter->view+1;
        $productCounter->save();

        $promoDetail = PromoDetail::where('product_detail_id',$id)->get();
        $anotherProductSize = ProductDetail::where('product_id',$productDetail->product_id)->whereNotIn('id', [$id])->get();

        foreach ($anotherProductSize as $key => $value) {
            $value->stock = $this->calc_stock($value->id);
        }

        
        $product = Product::where('id',$productDetail->product_id)->has('detail')->first();
        $category = $productDetail->category_id;
        $color = $product->color_id;
        $sizechart = $product->size_id;
        $settingSuggestion = SettingSuggestion::all();
        if($settingSuggestion->count()){
            $productSuggestion = array();
            foreach ($settingSuggestion as $key => $value) {
                # code...
                array_push($productSuggestion, $value->product->id);
            }
            $relateProducts = Product::where('id','<>', $product->id)->has('detail')->whereIn('id', $productSuggestion)->limit(5)->get();
        }else{
            $relateProducts = Product::where('id','<>', $product->id)->has('detail')->limit(5)->get();
        }
        
        $data = [
            'title' => $product->seo_title ? $product->seo_title : $product->product_title,
            'category' => $category,
            'color' => $color,
            'promoDetail' => $promoDetail,
            'sizechart' => $sizechart,
            'relateProducts' => $relateProducts,
            'productDetail' => $productDetail,
            'anotherProductSize' => $anotherProductSize,
            'stock' => $this->calc_stock($id)
        ];

        return view(
            'site.product-detail'
            ,['data'=>$data]
        );
    }

    public function howToOrder(){
        return view('site.how-to-order');
    }

    public function faq(){

        $data= FAQ::all();

        return view(
            'site.faq', 
            ['data'=>$data]
        );
    }

    public function sizeRecomendation(){
        $size= Size::orderBy('point', 'desc')->get();
        $measurement = [];
        foreach ($size as $key => $value) {
            $measurement[$key]['code']=$value->size_code;
            $measurement[$key]['point']=$value->point;
        }

        
        return view('site.size-recommendation', ['measurement'=>$measurement]);
    }

    public function feedback(){
        return view('site.feedback');
    }

    public function sendFeedback(Request $request){
        $data = [
            'feedback'=>request('feedback'), 
            'ip_address'=>$request->ip()
        ];
        $simpan = Feedback::create($data);
        Session::flash('message', 'Success send feedback!'); 
        Session::flash('alert-class', 'alert-info'); 
        return redirect()->route('shop.feedback');
    }

    public function sendFeedbackidea(Request $request){
        $data = [
            'url'=>request('url'), 
            'ip_address'=>$request->ip()
        ];
        $simpan = FeedbackIdea::create($data);
        Session::flash('message', 'Success send design!'); 
        Session::flash('alert-class', 'alert-info'); 
        return redirect()->route('shop.feedback');
    }

    private function calc_stock($id){
        $result = [];
        $product = ProductDetail::where('id', $id)->get();
        
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

            //DIKURANGI DARI SELURUH ENDORSE
            $orderDetail = EndorseDetail::where('product_detail_id', $valueProduct->id)->get();
            $quantity = 0;
            foreach ($orderDetail as $keyOrderDetail => $valueOrderDetail) {
                $quantity = $quantity + $valueOrderDetail->quantity;
            }
            $result[$valueProduct->id]['endorse'] = $quantity;
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

        return $result[$valueProduct->id]['stock'];
    }
}

