<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeedbackIdea;
 
class FeedbackIdeaController extends Controller
{
    public function index(){

        $feedback = FeedbackIdea::all();
        $data = [
            'feedback' => $feedback
        ];
        return view(
            'admin.feedback_idea'
            ,['data'=>$data]
        );
    }


    public function delete($id, Request $request)
    {
        $cabang = FeedbackIdea::findOrFail($id);
        $cabang->delete();

        return redirect()->route('feedback_idea');
    }
}

