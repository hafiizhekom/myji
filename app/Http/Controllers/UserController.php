<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){

        $user = User::orderBy('id', 'desc')->get();
        $data = [
            'user' => $user
        ];
        return view(
            'admin.user' 
            ,['data'=>$data]
        );
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        

       	$data = [ 
            'name'=>request('name'),
        ];

        
            
            if(request('verified')){
                if(!$user->email_verified_at){
                    
                    $data['email_verified_at']=date('Y-m-d H:i:s');
                }
            }else{
                $data['email_verified_at']=NULL;
            }
            
        // dd($data);
        $user->update($data);
        return redirect()->route('user');
    }

    public function change_password(Request $request, $id)
    {

        $validated = $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'confirm_password' => ['same:new_password'],
        ]);
        
        if($validated){
            $user = User::findOrFail($id);
                
                $data = [ 
                    'password'=>Hash::make(request('new_password')),
                ];
                
                $user->update($data);
        }
        
       	
        return redirect()->route('user');
    }

    public function delete($id, Request $request)
    {
        $cabang = User::findOrFail($id);
        $cabang->delete();

        return redirect()->route('user');
    }
}

