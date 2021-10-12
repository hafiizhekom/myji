<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimony;
 
class TestimonyController extends Controller
{
    public function index(){

        $testimony = Testimony::all();
        $data = [
            'testimony' => $testimony
        ];
        return view(
            'admin.testimony'
            ,['data'=>$data]
        );
    }

    public function add()
    {
    	$data = [
            'testimony_name'=>request('testimony_name'), 
            'testimony_code'=>request('testimony_code')
        ];
        $simpan = Testimony::create($data);
        return redirect()->route('testimony');
    }

    public function edit($id)
    {
        $cabang = Testimony::findOrFail($id);
       	$data = [ 
            'testimony_name'=>request('testimony_name'), 
            'testimony_code'=>request('testimony_code')
        ];
        
        $cabang->update($data);
        return redirect()->route('testimony');
    }


    public function delete($id, Request $request)
    {
        $cabang = Testimony::findOrFail($id);
        $cabang->delete();

        return redirect()->route('testimony');
    }
}

