<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Testimony;
use App\Models\Color;
use App\Models\Size;
use App\Models\Volume;
use App\Models\Faq;
 
class SiteController extends Controller
{
    public function index(){

        $slider = Slider::orderBy('order', 'ASC')->get();
        $mostWanted = Product::orderBy('view','DESC')->limit(3)->get();
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
        $volumeParam = $r->vol ? $r->vol : 'all';
        
        
        $colors = Color::all();
        $volumes = Volume::all();

        $product_detail = ProductDetail::orderBy('created_at', 'DESC');

        
        if($r->color){
            $product_detail = $product_detail->whereHas('color', function($q) use($r){
                $q->where('color_code', $r->color);
            });  
        }

        if($r->vol){
            $product_detail = $product_detail->whereHas('volume', function($q) use($r){
                $q->where('volume_code', $r->vol);
            });  
        }

        
        $product_detail = $product_detail->paginate(9);

        $data = [
            'colors' => $colors,
            'volumes' => $volumes,
            'product_details' => $product_detail
        ];
        
        return view(
            'site.catalogue'
            ,['data'=>$data]
        );
    }

    public function productDetail(Request $r, $id){

        $product = Product::with('volume','volume.sizechart','color')->where('slug',$slug)->first();
        $volume = $product->volume;
        $color = $product->color;
        $sizechart = $product->volume->sizechart;

        $relateProducts = Product::where('volume_id', $product->volume_id)
                        ->where('id','<>', $product->id)->limit(4)->get();

        $data = [
            'title' => $product->seo_title ? $product->seo_title : $product->product_title,
            'volumes' => $volume,
            'color' => $color,
            'sizechart' => $sizechart,
            'relateProducts' => $relateProducts,
            'product' => $product
        ];

        return view(
            'site.product-detail'
            // ,['data'=>$data]
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
        return view('site.size-recomendation');
    }

    public function feedback(){
        return view('site.feedback');
    }
}

