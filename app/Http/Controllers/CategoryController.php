<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
 
class CategoryController extends Controller
{
    public function index(){

        $category = Category::all();
        $data = [
            'category' => $category
        ];
        return view(
            'admin.category'
            ,['data'=>$data]
        );
    }

    public function add()
    {
    	$data = [
            'category_name'=>request('category_name'), 
            'category_code'=>request('category_code')
        ];
        $simpan = Category::create($data);
        return redirect()->route('category');
    }

    public function edit($id)
    {
        $cabang = Category::findOrFail($id);
       	$data = [ 
            'category_name'=>request('category_name'), 
            'category_code'=>request('category_code')
        ];
        
        $cabang->update($data);
        return redirect()->route('category');
    }


    public function delete($id, Request $request)
    {
        $cabang = Category::findOrFail($id);
        $cabang->delete();

        return redirect()->route('category');
    }
}

