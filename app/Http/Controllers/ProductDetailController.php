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
        $productDetail = ProductDetail::where('product_id', $id)->orderBy('size_id', 'asc')->get();
        $size = Size::all();
        $data = [
            'product' => $product,
            'productDetail' => $productDetail,
            'size' => $size,
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
            'price'=>request('price'),
            'yard_per_piece'=>request('yard_per_piece'),
            'whatsapp_link'=>request('whatsapp_link'),
            'shopee_link'=>request('shopee_link'),
        ];
        $saveProductDetail = ProductDetail::create($dataDetail);

        $product = Product::find($id);
        $image = request('image');
        $ext =  $image->getClientOriginalExtension();
        $newNameImage = $product->product_code.'-'.$saveProductDetail->id.'.'.$ext;
        Storage::disk('public')->putFileAs('products', $image, $newNameImage);

        $dataDetail = [
            'image_file'=>$newNameImage
        ];
        $saveProductDetail->update($dataDetail);


        

        return redirect()->route('product_detail', $id);
    }

    public function edit($id, $iddetail)
    {
        
        
        $dataDetail = [
            'product_id'=>$id,
            'size_id'=>request('size'),
            'color_id'=>request('color'),
            'category_id'=>request('category'),
            'price'=>request('price'),
            'yard_per_piece'=>request('yard_per_piece'),
            'whatsapp_link'=>request('whatsapp_link'),
            'shopee_link'=>request('shopee_link'),
        ];
        
        $product = Product::find($id);
        if(Request::has('image')){
            $image = request('image');
            $ext =  request('image')->getClientOriginalExtension();
            $newNameImage = $product->product_code.'-'.$iddetail.'.'.$ext;

            Storage::disk('public')->putFileAs('products', $image, $newNameImage);
            $dataDetail['image_file'] = $newNameImage;
        }

        $productDetail = ProductDetail::findOrFail($iddetail);
        
       
        $productDetail->update($dataDetail);
        
        return redirect()->route('product_detail', $id);
    }


    public function delete($id,$iddetail, Request $request)
    {
        $productDetail = ProductDetail::findOrFail($iddetail);
        $productDetail->delete();

        return redirect()->route('product_detail', $id);
    }
}

