<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;
 
class ColorController extends Controller
{
    public function index(){

        $color = Color::all();
        $data = [
            'color' => $color
        ];
        return view(
            'admin.color'
            ,['data'=>$data]
        );
    }

    public function add()
    {
    	$data = [
            'color_name'=>request('color_name'), 
            'color_code'=>request('color_code'),
            'color_hex'=>request('color_hex'),
        ];
        $simpan = Color::create($data);
        return redirect()->route('color');
    }

    public function edit($id)
    {
        $cabang = Color::findOrFail($id);
       	$data = [ 
            'color_name'=>request('color_name'), 
            'color_code'=>request('color_code'),
            'color_hex'=>request('color_hex'),
        ];
        
        $cabang->update($data);
        return redirect()->route('color');
    }


    public function delete($id, Request $request)
    {
        $cabang = Color::findOrFail($id);
        $cabang->delete();

        return redirect()->route('color');
    }
}

