<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MailController extends Controller
{
    //mailPost
    public function mailPost(Request $request){
        $validatingRules = [
            'name'=> ['required'],
            'email'=> ['required'],
            'subject'=>['required'],
            'message'=> ['required']
        ];
        Validator::make($request->all(),$validatingRules)->validate();
        $data = [
            'name'=> $request->name,
            'email'=>$request->email,
            'subject'=>$request->subject,
            'message'=> $request->message
        ];
        Mail::create($data);
        return redirect()->route('dashboard')->with(['emailPosted'=> 'Email Posted to Admin Team']);
    }
}
