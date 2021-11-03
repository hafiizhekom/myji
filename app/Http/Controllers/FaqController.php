<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
 
class FaqController extends Controller
{
    public function index(){

        $faq = Faq::all();
        $data = [
            'faq' => $faq
        ];
        return view(
            'admin.faq'
            ,['data'=>$data]
        );
    }

    public function add()
    {
    	$data = [
            'faq_name'=>request('faq_name'), 
            'faq_code'=>request('faq_code')
        ];
        $simpan = Faq::create($data);
        return redirect()->route('faq');
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
       	$data = [ 
            'faq_name'=>request('faq_name'), 
            'faq_code'=>request('faq_code')
        ];
        
        $faq->update($data);
        return redirect()->route('faq');
    }


    public function delete($id, Request $request)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('faq');
    }
}

