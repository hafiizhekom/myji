<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingSuggestion;
use App\Models\Product;
 
class SettingSuggestionController extends Controller
{
    public function index(){

        $setting_suggestion = SettingSuggestion::all();
        $product = Product::orderBy('id','desc')->get();
        $data = [
            'setting_suggestion' => $setting_suggestion,
            'product' => $product,
        ];
        
        return view(
            'admin.setting.suggestion'
            ,['data'=>$data]
        );
    }

    public function add()
    {
    	$data = [
            'product_id'=>request('product_id'),
            'order' => SettingSuggestion::max('order')+1
        ];
        $simpan = SettingSuggestion::create($data);
        return redirect()->route('setting.suggestion');
    }

    public function edit($id)
    {
        $cabang = SettingSuggestion::findOrFail($id);
       	$data = [ 
            'product_id'=>request('product_id'),
        ];
        
        $cabang->update($data);
        return redirect()->route('setting.suggestion');
    }

    public function increasingOrder($id)
    {
        $setting_suggestion = SettingSuggestion::where('id',$id)->first();
        $setting_suggestionTop = SettingSuggestion::where('order', $setting_suggestion->order + 1)->first();

        
        if($setting_suggestionTop){
            $setting_suggestionTop->update(['order'=>$setting_suggestion->order]);
        }

        $setting_suggestion->update(['order'=>$setting_suggestion->order + 1]);
        return redirect()->route('setting.suggestion');
    }

    public function decreasingOrder($id)
    {
        $setting_suggestion = SettingSuggestion::where('id',$id)->first();
        $setting_suggestionBot = SettingSuggestion::where('order', $setting_suggestion->order - 1)->first();

        if($setting_suggestionBot){
            $setting_suggestionBot->update(['order'=>$setting_suggestion->order]);
        }

        $setting_suggestion->update(['order'=>$setting_suggestion->order - 1]);
        return redirect()->route('setting.suggestion');
    }


    public function delete($id, Request $request)
    {
        $cabang = SettingSuggestion::findOrFail($id);
        $cabang->delete();

        return redirect()->route('setting.suggestion');
    }
}

