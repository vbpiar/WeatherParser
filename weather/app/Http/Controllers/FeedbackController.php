<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{


    protected function validator(Request $request)
    {


        //check if User register
        if (Auth::check()) {
            //if true validate values for register user
            $validator = Validator::make($request->all(), [
                'name' => 'nullable',
                'email' => 'nullable',
                'text' => 'required|string|max:255',
            ]);
        }
        else
        {
            //if false validate values for not register user
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'text' => 'required|string|max:255',
            ]);
        }
        return $validator;

    }
    public function create(Request $request)
    {

        $validator = $this->validator($request);

            // if validation false redirect user on the same page
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }else {

                // create new Feedback and store it
            $feedback = new Feedback();

            $feedback->name = $request['name'];

            $feedback->email = $request['email'];

            $feedback->text = $request['text'];

            Auth::check() ? $feedback->user_id = auth()->user()->id : $feedback->user_id = null; // create eloquent id if user register

            $feedback->save();

            return redirect()->route('feedback.show');
        }
    }

    public function show()
    {

        $feedback = DB::select(DB::raw(
            'SELECT   concat(users.fname," ",users.lname) AS name, users.email ,feedback.text
                    FROM feedback 
                    JOIN users  ON users.id = feedback.user_id
                    UNION SELECT feedback.name , feedback.email , feedback.text FROM feedback WHERE feedback.name IS NOT NULL AND feedback.email IS NOT NULL'
        )); // select feedback with names and emails for both types : register and not register

        return view('feedback.show',['feedback'=>$feedback]);
    }


}
