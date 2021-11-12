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

    public function add(Request $request)
    {
         
                
    	$data = [
            'product_name'=>request('product_name'), 
            'product_code'=>request('product_code'),
            'color_id'=>request('color'),
            'category_id'=>request('category'),
        ];
        $simpan = Product::create($data);

        if($request->hasfile('image')) 
        {  
            $image = $request->file('image');
            $ext =  $image->getClientOriginalExtension();
            $newNameImage = $simpan->id.'.'.$ext;
            Storage::disk('public')->putFileAs('productions', $image, $newNameImage);
        }

        $file = [
            'image_file'=>$newNameImage
        ];

        $simpan->update($file);
        return redirect()->route('product');
    }

    public function edit(Request $request, $id)
    {
        $cabang = Product::findOrFail($id);
       
        if($request->hasfile('image')) 
        {  
            $image = $request->file('image');
            $ext =  $image->getClientOriginalExtension();
            $newNameImage = $id.'.'.$ext;
            Storage::disk('public')->putFileAs('productions', $image, $newNameImage);

            $data = [ 
                'product_name'=>request('product_name'), 
                'product_code'=>request('product_code'),
                'color_id'=>request('color'),
                'category_id'=>request('category'),
                'image_file'=>$newNameImage
            ];
        }else{
            $data = [ 
                'product_name'=>request('product_name'), 
                'product_code'=>request('product_code'),
                'color_id'=>request('color'),
                'category_id'=>request('category'),
            ];
        }
        
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

