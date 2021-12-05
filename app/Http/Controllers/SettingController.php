<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
 
class SettingController extends Controller
{
    public function index(){

        // $setting_suggestion = SettingSuggestion::all();
        // $product = Product::orderBy('id','desc')->get();
        // $data = [
        //     'setting_suggestion' => $setting_suggestion,
        //     'product' => $product,
        // ];
        
        return view(
            'admin.setting.general'
        );
    }

    public function size_recommendation(Request $request)
    {
        if($request->hasfile('image')) 
        {  
            $image = $request->file('image');
            $ext =  $image->getClientOriginalExtension();
            $newNameImage = 'image.jpg';
            Storage::disk('public')->putFileAs('settings/size_recommendation', $image, $newNameImage);
            $file['image_file']=$newNameImage;
        }
        return redirect()->route('setting.general');
    }
}

