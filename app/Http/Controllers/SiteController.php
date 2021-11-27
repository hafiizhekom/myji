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
use App\Models\FAQ;
 
class SiteController extends Controller
{
    public function index(){

        $slider = Slider::orderBy('order', 'ASC')->get();
        $mostWanted = Product::with('detail.productDetailImage')->orderBy('view','DESC')->limit(3)->get();

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
        $colorParam = $r->color ? $r->color : 'all';
        $categoryParam = $r->category ? $r->category : 'all';
        
        
        $color = Color::all();
        $category = Category::all();
        $size = Size::all();

        $product_detail = ProductDetail::orderBy('created_at', 'DESC');

        
        if($r->color){
            $product_detail = $product_detail->whereHas('color', function($q) use($r){
                $q->where('color_code', $r->color);
            });  
        }

        if($r->category){
            $product_detail = $product_detail->whereHas('category', function($q) use($r){
                $q->where('category_code', $r->vol);
            });  
        }

        
        $product_detail = $product_detail->paginate(9);

        $data = [
            'color' => $color,
            'category' => $category,
            'size' => $size,
            'product_detail' => $product_detail
        ];
        
        return view(
            'site.catalogue'
            ,['data'=>$data]
        );
    }

    public function productDetail(Request $r, $id){

        $productDetail = ProductDetail::where('id',$id)->first();
        $anotherProductSize = ProductDetail::where('category_id', $productDetail->category_id)->where('color_id', $productDetail->color_id)->where('product_id',$productDetail->product_id)->get();
        $product = Product::where('id',$productDetail->product_id)->first();
        $category = $productDetail->category_id;
        $color = $product->color_id;
        $sizechart = $product->size_id;

        $relateProducts = ProductDetail::where('category_id', $product->category_id)
                        ->where('id','<>', $product->id)->limit(4)->get();

        $data = [
            'title' => $product->seo_title ? $product->seo_title : $product->product_title,
            'category' => $category,
            'color' => $color,
            'sizechart' => $sizechart,
            'relateProducts' => $relateProducts,
            'productDetail' => $productDetail,
            'anotherProductSize' => $anotherProductSize
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

        
        return view('site.size-recomendation', ['measurement'=>$measurement]);
    }

    public function feedback(){
        return view('site.feedback');
    }
}

