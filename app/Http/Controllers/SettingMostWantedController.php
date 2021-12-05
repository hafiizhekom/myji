<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingMostWanted;
use App\Models\Product;
 
class SettingMostWantedController extends Controller
{
    public function index(){

        $setting_most_wanted = SettingMostWanted::all();
        $product = Product::orderBy('id','desc')->get();
        $data = [
            'setting_most_wanted' => $setting_most_wanted,
            'product' => $product,
        ];
        
        return view(
            'admin.setting.most_wanted'
            ,['data'=>$data]
        );
    }

    public function add()
    {
    	$data = [
            'product_id'=>request('product_id'),
            'order' => SettingMostWanted::max('order')+1
        ];
        $simpan = SettingMostWanted::create($data);
        return redirect()->route('setting.most_wanted');
    }

    public function edit($id)
    {
        $cabang = SettingMostWanted::findOrFail($id);
       	$data = [ 
            'product_id'=>request('product_id'),
        ];
        
        $cabang->update($data);
        return redirect()->route('setting.most_wanted');
    }

    public function increasingOrder($id)
    {
        $setting_most_wanted = SettingMostWanted::where('id',$id)->first();
        $setting_most_wantedTop = SettingMostWanted::where('order', $setting_most_wanted->order + 1)->first();

        
        if($setting_most_wantedTop){
            $setting_most_wantedTop->update(['order'=>$setting_most_wanted->order]);
        }

        $setting_most_wanted->update(['order'=>$setting_most_wanted->order + 1]);
        return redirect()->route('setting.most_wanted');
    }

    public function decreasingOrder($id)
    {
        $setting_most_wanted = SettingMostWanted::where('id',$id)->first();
        $setting_most_wantedBot = SettingMostWanted::where('order', $setting_most_wanted->order - 1)->first();

        if($setting_most_wantedBot){
            $setting_most_wantedBot->update(['order'=>$setting_most_wanted->order]);
        }

        $setting_most_wanted->update(['order'=>$setting_most_wanted->order - 1]);
        return redirect()->route('setting.most_wanted');
    }


    public function delete($id, Request $request)
    {
        $cabang = SettingMostWanted::findOrFail($id);
        $cabang->delete();

        return redirect()->route('setting.most_wanted');
    }
}

