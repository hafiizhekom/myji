<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductDetailImage;
use App\Models\Testimony;
use App\Models\Color;
use App\Models\Size;
use App\Models\Category;
use App\Models\FAQ;
use App\Models\Feedback;
use App\Models\FeedbackIdea;
use Session;
 
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

        $product = Product::has('detail.productDetailImage')->orderBy('created_at', 'DESC');

        
        if($r->color){
            $product = $product->whereHas('color', function($q) use($r){
                $q->where('color_code', $r->color);
            });  
        }

        if($r->category){
            $product = $product->whereHas('category', function($q) use($r){
                $q->where('category_code', $r->category);
            });  
        }

        
        $product = $product->paginate(9);

        $data = [
            'color' => $color,
            'category' => $category,
            'product' => $product
        ];
        
        return view(
            'site.catalogue'
            ,['data'=>$data]
        );
    }

    public function productDetail(Request $r, $id){

        $productDetail = ProductDetail::has('productDetailImage')->where('id',$id)->first();
        $productDetailGallery= ProductDetailImage::where('main_image',0)->where('product_detail_id',$id)->get();
        $anotherProductSize = ProductDetail::where('product_id',$productDetail->product_id)->get();
        $product = Product::where('id',$productDetail->product_id)->has('detail.productDetailImage')->first();
        $category = $productDetail->category_id;
        $color = $product->color_id;
        $sizechart = $product->size_id;

        $relateProducts = Product::where('id','<>', $product->id)->has('detail.productDetailImage')->limit(4)->get();

        $data = [
            'title' => $product->seo_title ? $product->seo_title : $product->product_title,
            'category' => $category,
            'color' => $color,
            'sizechart' => $sizechart,
            'relateProducts' => $relateProducts,
            'productDetail' => $productDetail,
            'productDetailGallery' => $productDetailGallery,
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
}

