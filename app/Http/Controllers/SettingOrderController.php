<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingOrder;
 
class SettingOrderController extends Controller
{
    public function index(){

        $setting_order = SettingOrder::all();
        $data = [
            'setting_order' => $setting_order
        ];
        
        return view(
            'admin.setting.order'
            ,['data'=>$data]
        );
    }

    public function edit($id)
    {
        $cabang = SettingOrder::findOrFail($id);
       	$data = [ 
            'order_fee'=>request('order_fee'),
            'active'=>request('active')
        ];
        
        $cabang->update($data);
        return redirect()->route('setting.order');
    }

}

