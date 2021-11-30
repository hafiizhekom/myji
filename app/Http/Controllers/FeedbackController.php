<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
 
class FeedbackController extends Controller
{
    public function index(){

        $feedback = Feedback::all();
        $data = [
            'feedback' => $feedback
        ];
        return view(
            'admin.feedback'
            ,['data'=>$data]
        );
    }


    public function delete($id, Request $request)
    {
        $cabang = Feedback::findOrFail($id);
        $cabang->delete();

        return redirect()->route('feedback');
    }
}

