<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;
 
class SizeController extends Controller
{
    public function index(){

        $size = Size::all();
        $data = [
            'size' => $size
        ];
        return view(
            'admin.size'
            ,['data'=>$data]
        );
    }

    public function add()
    {
    	$data = [
            'size_name'=>request('size_name'), 
            'size_code'=>request('size_code'),
            'point'=>request('point'),
        ];
        $simpan = Size::create($data);
        return redirect()->route('size');
    }

    public function edit($id)
    {
        $cabang = Size::findOrFail($id);
       	$data = [ 
            'size_name'=>request('size_name'), 
            'size_code'=>request('size_code'),
            'point'=>request('point'),
        ];
        
        $cabang->update($data);
        return redirect()->route('size');
    }


    public function delete($id, Request $request)
    {
        $cabang = Size::findOrFail($id);
        $cabang->delete();

        return redirect()->route('size');
    }
}

