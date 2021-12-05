<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductDetailImage;
use App\Models\Color;
use App\Models\Size;
use App\Models\Category;
use Storage;

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
         
        if(!request('description')){
            $data['description']="";
        }
                
    	
        $simpan = Product::create($data);


        $file = [];
        if($request->hasfile('image')) 
        {  
            $image = $request->file('image');
            $ext =  $image->getClientOriginalExtension();
            $newNameImage = $simpan->id.'.'.$ext;
            Storage::disk('public')->putFileAs('productions', $image, $newNameImage);
            $file['image_file']=$newNameImage;
        }

        if($request->hasfile('chart_size')) 
        {  
            $image = $request->file('chart_size');
            $ext =  $image->getClientOriginalExtension();
            $newNameImage = $simpan->id.'.'.$ext;
            Storage::disk('public')->putFileAs('charts', $image, $newNameImage);
            $file['chart_size_image']=$newNameImage;
        }

        $dataDetail = [
            'product_id'=>$simpan->id,
            'size_id'=>Size::first()->id, 
            'price'=>0,
            'yard_per_piece'=>0,
            'shopee_link'=>'',
            'whatsapp_link'=>''
        ];
        $simpanDetail = ProductDetail::create($dataDetail);

        $dataDetailImage = [
            'product_detail_id'=>$simpanDetail->id,
            'file'=>'default.jpg',
            'main_image'=>1
        ];
        $simpanDetailImage = ProductDetailImage::create($dataDetailImage);



        $simpan->update($file);
        return redirect()->route('product');
    }

    public function edit(Request $request, $id)
    {
        $cabang = Product::findOrFail($id);
        $data = [ 
            'product_name'=>request('product_name'), 
            'product_code'=>request('product_code'),
            'color_id'=>request('color'),
            'category_id'=>request('category'),
        ];

        if(!request('description')){
            $data['description']="";
        }

        if($request->hasfile('image')) 
        {  
            $image = $request->file('image');
            $ext =  $image->getClientOriginalExtension();
            $newNameImage = $id.'.'.$ext;
            Storage::disk('public')->putFileAs('productions', $image, $newNameImage);
            $data['image_file']=$newNameImage;
        }

        if($request->hasfile('chart_size')) 
        {  
            $image = $request->file('chart_size');
            $ext =  $image->getClientOriginalExtension();
            $newNameImage = $id.'.'.$ext;
            Storage::disk('public')->putFileAs('charts', $image, $newNameImage);
            $data['chart_size_image']=$newNameImage;
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

