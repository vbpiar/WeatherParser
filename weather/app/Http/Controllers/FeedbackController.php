<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller
{

    public function create(Request $request)
    {

        $feedback = new Feedback();

        $feedback->name = $request['name'];

        $feedback->email =  $request['email'];

        $feedback->text = $request['text'];

        Auth::check()?$feedback->user_id = auth()->user()->id:$feedback->user_id =null;

        $feedback->save();

        return redirect()->route('feedback.show');
    }

    public function show()
    {

        $feedback = DB::select(DB::raw(
            'SELECT   concat(users.fname," ",users.lname) AS name, users.email ,feedback.text
                    FROM feedback 
                    JOIN users  ON users.id = feedback.user_id
                    UNION SELECT feedback.name , feedback.email , feedback.text FROM feedback WHERE feedback.name IS NOT NULL AND feedback.email IS NOT NULL'
        ));

        return view('feedback.show',['feedback'=>$feedback]);
    }


}
