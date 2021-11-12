<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Endorse;
use App\Models\EndorseDetail;
use App\Models\ProductDetail;
use App\Models\Channel;
use App\Models\Customer;
 
class EndorseController extends Controller
{
    public function index(){

        $endorseAll = Endorse::all();
        $endorse = Endorse::all();
        $channel = Channel::all();
        $customer = Customer::all();
        $data = [
            'endorseAll' => $endorseAll,
            'endorse' => $endorse,
            'channel' => $channel,
            'customer' => $customer,
        ];
        return view(
            'admin.endorse'
            ,['data'=>$data]
        );
    }

    public function add()
    {

    	$data = [
            'channel_id'=>request('channel_id'), 
            'customer_id'=>request('customer_id'),
            'address_shipping'=>request('address_shipping'),
            'endorse_date'=>request('endorse_date')
        ];
        $simpan = Endorse::create($data);
        
        return redirect()->route('endorse');
    }

    public function edit($id)
    {
        $endorse = Endorse::findOrFail($id);
        $data = [
            'channel_id'=>request('channel_id'), 
            'customer_id'=>request('customer_id'),
            'address_shipping'=>request('address_shipping'),
            'endorse_date'=>request('endorse_date'),
        ];
        
        $endorse->update($data);
        return redirect()->route('endorse');
    }


    public function delete($id, Request $request)
    {
        $endorse = Endorse::findOrFail($id);
        $endorse->delete();

        return redirect()->route('endorse');
    }
}

