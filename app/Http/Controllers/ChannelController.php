<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Channel;
 
class ChannelController extends Controller
{
    public function index(){

        $channel = Channel::all();
        $data = [
            'channel' => $channel
        ];
        
        return view(
            'admin.channel'
            ,['data'=>$data]
        );
    }

    public function add()
    {
    	$data = [
            'channel_name'=>request('channel_name'), 
            'fixed_fee'=>request('fixed_fee'),
            'percentage_fee'=>request('percentage_fee'),
            'active'=>request('active')
        ];
        $simpan = Channel::create($data);
        return redirect()->route('channel');
    }

    public function edit($id)
    {
        $cabang = Channel::findOrFail($id);
       	$data = [ 
            'channel_name'=>request('channel_name'), 
            'fixed_fee'=>request('fixed_fee'),
            'percentage_fee'=>request('percentage_fee'),
            'active'=>request('active')
        ];
        
        $cabang->update($data);
        return redirect()->route('channel');
    }


    public function delete($id, Request $request)
    {
        $cabang = Channel::findOrFail($id);
        $cabang->delete();

        return redirect()->route('channel');
    }
}

