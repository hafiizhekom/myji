<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingSizeChart;
use Storage;

class SettingSizeChartController extends Controller
{
    public function index(){

        $setting_size_chart = SettingSizeChart::orderBy('order', 'desc')->get();
        $data = [
            'setting_size_chart' => $setting_size_chart
        ];
        return view(
            'admin.setting.size_chart' 
            ,['data'=>$data]
        );
    }

    public function add(Request $request)
    {
    	$data = [
            'order'=>SettingSizeChart::max('order')+1
        ];
        $simpan = SettingSizeChart::create($data);

        if($request->hasfile('image')) 
        {  
            $image = $request->file('image');
            $ext =  $image->getClientOriginalExtension();
            $newNameImage = $simpan->id.'.'.$ext;
            Storage::disk('public')->putFileAs('settings/size_charts', $image, $newNameImage);

            $file = [
                'image_file'=>$newNameImage
            ];

            $simpan->update($file);
    
        }

        
        

        return redirect()->route('setting.size_chart');
    }

    public function increasingOrder($id)
    {
        $setting_size_chart = SettingSizeChart::where('id',$id)->first();
        $setting_size_chartTop = SettingSizeChart::where('order', $setting_size_chart->order + 1)->first();

        
        if($setting_size_chartTop){
            $setting_size_chartTop->update(['order'=>$setting_size_chart->order]);
        }

        $setting_size_chart->update(['order'=>$setting_size_chart->order + 1]);
        return redirect()->route('setting_size_chart');
    }

    public function decreasingOrder($id)
    {
        $setting_size_chart = SettingSizeChart::where('id',$id)->first();
        $setting_size_chartBot = SettingSizeChart::where('order', $setting_size_chart->order - 1)->first();

        if($setting_size_chartBot){
            $setting_size_chartBot->update(['order'=>$setting_size_chart->order]);
        }

        $setting_size_chart->update(['order'=>$setting_size_chart->order - 1]);
        return redirect()->route('setting.size_chart');
    }


    public function delete($id, Request $request)
    {
        $cabang = SettingSizeChart::findOrFail($id);
        $cabang->delete();

        return redirect()->route('setting.size_chart');
    }
}

