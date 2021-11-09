<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Color;
use App\Models\Size;
use App\Models\Category;
use Storage;
use Image;
class ProductController extends Controller
{
    public function index(){

        $product = Product::all();
        $color = Color::all();
        $category = Category::all();
        $size = Size::all();
       
        $data = [
            'product' => $product,
            'size' => $size,
            'color' => $color,
            'category' => $category
        ];
        return view(
            'admin.product'
            ,['data'=>$data]
        );
    }

    public function add()
    {
    	$data = [
            'product_name'=>request('product_name'), 
            'product_code'=>request('product_code'),
            'color_id'=>request('color'),
            'category_id'=>request('category'),
        ];
        $simpan = Product::create($data)->id;

        return redirect()->route('product');
    }

    public function edit($id)
    {
        $cabang = Product::findOrFail($id);
       	$data = [ 
            'product_name'=>request('product_name'), 
            'product_code'=>request('product_code'),
            'color_id'=>request('color'),
            'category_id'=>request('category'),
        ];
        
        $cabang->update($data);
        return redirect()->route('product');
    }


    public function delete($id, Request $request)
    {
        $cabang = Product::findOrFail($id);
        $cabang->delete();

        return redirect()->route('product');
    }
}

