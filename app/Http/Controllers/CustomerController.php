<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
 
class CustomerController extends Controller
{
    public function index(){

        $customer = Customer::all();
        $data = [
            'customer' => $customer
        ];
        return view(
            'admin.customer'
            ,['data'=>$data]
        );
    }

    public function add()
    {
    	$data = [
            'first_name'=>request('first_name'), 
            'last_name'=>request('last_name'),
            'gender'=>request('gender'),
            'email'=>request('email'),
            'phone'=>request('phone'),
            'address'=>request('address'),
        ];
        $simpan = Customer::create($data);
        return redirect()->route('customer');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        $data = [
            'first_name'=>request('first_name'), 
            'last_name'=>request('last_name'),
            'gender'=>request('gender'),
            'email'=>request('email'),
            'phone'=>request('phone'),
            'address'=>request('address'),
        ];
        
        $customer->update($data);
        return redirect()->route('customer');
    }


    public function delete($id, Request $request)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customer');
    }
}

