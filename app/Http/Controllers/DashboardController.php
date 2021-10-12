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
 
class DashboardController extends Controller
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
            'admin.dashboard'
            ,['data'=>$data]
        );
    }
}

