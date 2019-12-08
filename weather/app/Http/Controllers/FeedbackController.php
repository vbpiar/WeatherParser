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

    public function store(Request $request)
    {
          $request->validate([
                'name' => 'nullable,string|max:255',
                'email' => 'nullable,string|email|max:255|unique:users',
                'text' => 'required|string|max:255',
            ]);
                // create new Feedback and store it
            $feedback = new Feedback();
            $feedback->name = $request['name'];
            $feedback->email = $request['email'];
            $feedback->text = $request['text'];
            Auth::check() ? $feedback->user_id = auth()->user()->id : $feedback->user_id = null; // create associate id if user register
            $feedback->save();

            return redirect()->route('feedback.show');

    }

    public function show()
    {
//        DB::connection()->enableQueryLog();

        $feedback = Feedback::with(['user' => function($query){
            $query->select('id','fname','lname','email');
        }])->get(['name','email','text','user_id']);

//        dd($feedback);
        return view('feedback.show',['feedback'=>$feedback]);
    }

    public function create()
    {
        return view('feedback.create');

    }


}
