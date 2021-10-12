<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Color;
use App\Models\Size;
use App\Models\Category;
use Storage;
use Image;
use Request;

class ProductDetailController extends Controller
{
    public function index($id){

        $product = Product::where('id', $id)->get();
        $productDetail = ProductDetail::where('product_id', $id)->get();
        $color = Color::all();
        $size = Size::all();
        $category = Category::all();
        $data = [
            'product' => $product,
            'productDetail' => $productDetail,
            'size' => $size,
            'color' => $color,
            'category' => $category,
            'id' =>$id
        ];
        return view(
            'admin.product_detail'
            ,['data'=>$data]
        );
    }

    public function add($id)
    {

        $dataDetail = [
            'product_id'=>$id,
            'size_id'=>request('size'),
            'color_id'=>request('color'),
            'category_id'=>request('category'),
            'price'=>request('price'),
            'yard_per_piece'=>request('yard_per_piece')
        ];
        $saveProductDetail = ProductDetail::create($dataDetail);

        $product = Product::find($id);
        $image = request('image');
        $ext =  $image->getClientOriginalExtension();
        $newNameImage = $product->product_code.'-'.$saveProductDetail->id.'.'.$ext;
        Storage::disk('public')->putFileAs('products', $image, $newNameImage);

        $dataDetail = [
            'design_image_path'=>$newNameImage
        ];
        $saveProductDetail->update($dataDetail);

        return redirect()->route('product_detail', $id);
    }

    public function edit($id, $iddetail)
    {
        $product = Product::find($id);
        if(Request::has('image')){
            $image = request('image');
            $ext =  request('image')->getClientOriginalExtension();
            $newNameImage = $product->product_code.'-'.$id.'.'.$ext;

            echo Storage::disk('public')->putFileAs('products', $image, $newNameImage);
            $dataDetail = [
                'product_id'=>$id,
                'size_id'=>request('size'),
                'color_id'=>request('color'),
                'category_id'=>request('category'),
                'price'=>request('price'),
                'yard_per_piece'=>request('yard_per_piece'),
                'design_image_path'=>$newNameImage
            ];
        }else{
            $dataDetail = [
                'product_id'=>$id,
                'size_id'=>request('size'),
                'color_id'=>request('color'),
                'category_id'=>request('category'),
                'price'=>request('price'),
                'yard_per_piece'=>request('yard_per_piece')
            ];
        }

        $cabang = ProductDetail::findOrFail($id);
       
        $cabang->update($dataDetail);
        return redirect()->route('product_detail', $id);
    }


    public function delete($id, Request $request)
    {
        $cabang = Product::findOrFail($id);
        $cabang->delete();

        return redirect()->route('product');
    }
}

