<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{

    public function create(Request $request)
    {

          $request->validate([
                'name' => 'string|max:255',
                'email' => 'string|email|max:255|unique:users',
                'text' => 'required|string|max:255',
            ]);

                // create new Feedback and store it
            $feedback = new Feedback();
            $feedback->name = $request['name'];
            $feedback->email = $request['email'];
            $feedback->text = $request['text'];
            Auth::check() ? $feedback->user_id = auth()->user()->id : $feedback->user_id = null; // create eloquent id if user register

            $feedback->save();

            return redirect()->route('feedback.show');

    }

    public function show()
    {
        $feedback = Feedback::all();
        return view('feedback.show',['feedback'=>$feedback]);
    }


}
