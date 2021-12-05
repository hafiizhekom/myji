<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
 
class FaqController extends Controller
{
    public function index(){

        $faq = Faq::orderBy('order', 'desc')->get();
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
            'title'=>request('title'), 
            'content'=>request('content'),
            'order' => Faq::max('order')+1

        ];
        $simpan = Faq::create($data);
        return redirect()->route('faq');
    }

    public function increasingOrder($id)
    {
        $faq = Faq::where('id',$id)->first();
        $faqTop = Faq::where('order', $faq->order + 1)->first();

        if($faqTop){
            $faqTop->update(['order'=>$faq->order]);
        }

        $faq->update(['order'=>$faq->order + 1]);
        return redirect()->route('faq');
    }

    public function decreasingOrder($id)
    {
        $faq = Faq::where('id',$id)->first();
        $faqBot = Faq::where('order', $faq->order - 1)->first();

        if($faqBot){
            $faqBot->update(['order'=>$faq->order]);
        }

        $faq->update(['order'=>$faq->order - 1]);
        return redirect()->route('faq');
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
       	$data = [ 
            'title'=>request('title'), 
            'content'=>request('content')
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

