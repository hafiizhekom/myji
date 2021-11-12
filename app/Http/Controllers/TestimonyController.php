<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimony;
use Storage;

class TestimonyController extends Controller
{
    public function index(){

        $testimony = Testimony::orderBy('order', 'desc')->get();
        $data = [
            'testimony' => $testimony
        ];
        return view(
            'admin.testimony' 
            ,['data'=>$data]
        );
    }

    public function add(Request $request)
    { 

        $lastTesti = Testimony::orderBy('order', 'desc')->first();
        if(!$lastTesti){
            $lastOrder = 1;
        }else{
            $lastOrder = $lastTesti->order+1;
        }

    	$data = [
            'title'=>request('title'),
            'order' => $lastOrder
        ];
        $simpan = Testimony::create($data);

        if($request->hasfile('image')) 
        {  
            $image = $request->file('image');
            $ext =  $image->getClientOriginalExtension();
            $newNameImage = $simpan->id.'.'.$ext;
            Storage::disk('public')->putFileAs('testimonies', $image, $newNameImage);

            $file = [
                'image'=>$newNameImage
            ];

            $simpan->update($file);
    
        }

        
        

        return redirect()->route('testimony');
    }

    public function edit(Request $request, $id)
    {
        $cabang = Testimony::findOrFail($id);

        if($request->hasfile('image')) 
        {  
            $image = $request->file('image');
            $ext =  $image->getClientOriginalExtension();
            $newNameImage = $id.'.'.$ext;
            Storage::disk('public')->putFileAs('testimonies', $image, $newNameImage);

            $data = [ 
                'title'=>request('title'),
                'image'=>$newNameImage
            ];
        }else{
            $data = [ 
                'title'=>request('title')
            ];
        }

       	
        
        $cabang->update($data);
        return redirect()->route('testimony');
    }

    public function increasingOrder($id)
    {
        $testimony = Testimony::where('id',$id)->first();
        $testimonyTop = Testimony::where('order', $testimony->order + 1)->first();

        
        if($testimonyTop){
            $testimonyTop->update(['order'=>$testimony->order]);
        }

        $testimony->update(['order'=>$testimony->order + 1]);
        return redirect()->route('testimony');
    }

    public function decreasingOrder($id)
    {
        $testimony = Testimony::where('id',$id)->first();
        $testimonyBot = Testimony::where('order', $testimony->order - 1)->first();

        if($testimonyBot){
            $testimonyBot->update(['order'=>$testimony->order]);
        }

        $testimony->update(['order'=>$testimony->order - 1]);
        return redirect()->route('testimony');
    }


    public function delete($id, Request $request)
    {
        $cabang = Testimony::findOrFail($id);
        $cabang->delete();

        return redirect()->route('testimony');
    }
}

