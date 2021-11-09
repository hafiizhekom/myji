<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\ProductDetailImage;
use App\Models\ProductDetail;
use App\Models\Color;
use App\Models\Size;
use App\Models\Category;
use Storage;
use \Illuminate\Http\Request;

class ProductDetailImageController extends Controller
{
    public function index($id){

        // $product = Product::where('id', $product_id)->get();
        $productDetail = ProductDetail::where('id', $id)->get();
        $productDetailImage = ProductDetailImage::where('product_detail_id', $id)->orderBy('main_image', 'desc')->get();
        $data = [
            'productDetail' => $productDetail,
            'productDetailImage' => $productDetailImage,
            'id'=>$id
        ];
        return view(
            'admin.product_detail_image'
            ,['data'=>$data]
        );
    }

    public function add(Request $request, $id)
    {
        
       

        if($request->hasfile('image'))
        {
            foreach ($request->file('image') as $key => $image) {
                $product_detail = ProductDetail::find($id);
                if(ProductDetailImage::where('product_detail_id',$id)->where('main_image',1)->get()->count()>0){
                    $dataTemp = [
                        'product_detail_id' => $id,
                        'file'=>'-',
                        'main_image'=>0,
                    ];
                }else{
                    $dataTemp = [
                        'product_detail_id' => $id,
                        'file'=>'-',
                        'main_image'=>1,
                    ];
                }
                
                
                $saveProductImage = ProductDetailImage::create($dataTemp);

                $ext =  $image->getClientOriginalExtension();
                $newNameImage = $product_detail->product->product_code.'-'.$product_detail->id.'-'.$saveProductImage->id.'.'.$ext;
                Storage::disk('public')->putFileAs('products', $image, $newNameImage);

                $file = [
                    'file'=>$newNameImage
                ];

                $saveProductImage->update($file);
    
            }
        }
        

        
       

        return redirect()->route('product_detail_image', $id);
    }

    public function edit($id, $iddetail)
    {
        
        $image = ProductDetailImage::find($iddetail);
        $imageTempClear = ProductDetailImage::where('product_detail_id', $image->product_detail_id);
        $imageTempClear->update(['main_image'=>0]);

        $image->main_image=1;
        $image->save();
        
        return redirect()->route('product_detail_image', $id);
    }


    public function delete($id, $iddetail, Request $request)
    {
        $image = ProductDetailImage::findOrFail($iddetail);
        if($image->delete()){
            Storage::disk('public')->delete('products/'.$image->file);
        }

        return redirect()->route('product_detail_image', $id);
    }
}

