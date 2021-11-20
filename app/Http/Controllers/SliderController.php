<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Storage;

class SliderController extends Controller
{
    public function index(){

        $slider = Slider::orderBy('order', 'desc')->get();
        $data = [
            'slider' => $slider
        ];
        return view(
            'admin.slider' 
            ,['data'=>$data]
        );
    }

    public function add(Request $request)
    {
    	$data = [
            'title'=>request('title')
        ];
        $simpan = slider::create($data);

        if($request->hasfile('image')) 
        {  
            $image = $request->file('image');
            $ext =  $image->getClientOriginalExtension();
            $newNameImage = $simpan->id.'.'.$ext;
            Storage::disk('public')->putFileAs('sliders', $image, $newNameImage);

            $file = [
                'image'=>$newNameImage
            ];

            $simpan->update($file);
    
        }

        
        

        return redirect()->route('slider');
    }

    public function edit(Request $request, $id)
    {
        $cabang = slider::findOrFail($id);

        if($request->hasfile('image')) 
        {  
            $image = $request->file('image');
            $ext =  $image->getClientOriginalExtension();
            $newNameImage = $id.'.'.$ext;
            Storage::disk('public')->putFileAs('sliders', $image, $newNameImage);

            $data = [ 
                'title'=>request('title'),
                'image'=>$newNameImage
            ];
        }else{
            $data = [ 
                'title'=>request('title')
            ];
        }

       	
        
        $cabang->update($data);
        return redirect()->route('slider');
    }

    public function increasingOrder($id)
    {
        $slider = Slider::where('id',$id)->first();
        $sliderTop = Slider::where('order', $slider->order + 1)->first();

        
        if($sliderTop){
            $sliderTop->update(['order'=>$slider->order]);
        }

        $slider->update(['order'=>$slider->order + 1]);
        return redirect()->route('slider');
    }

    public function decreasingOrder($id)
    {
        $slider = Slider::where('id',$id)->first();
        $sliderBot = Slider::where('order', $slider->order - 1)->first();

        if($sliderBot){
            $sliderBot->update(['order'=>$slider->order]);
        }

        $slider->update(['order'=>$slider->order - 1]);
        return redirect()->route('slider');
    }


    public function delete($id, Request $request)
    {
        $cabang = slider::findOrFail($id);
        $cabang->delete();

        return redirect()->route('slider');
    }
}

