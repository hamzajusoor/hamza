<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use App\Mail\ReplyContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{


    public function email( Request $request) {

        $validation=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
            'message'=>'required',
        ]);
        if($validation->fails()){
            return response()->json(['error'=>$validation->errors()]);
        }
        Mail::to('hamza.jusoor@gmail.com')->send(new Contact($request->all()));
        Mail::to($request->email)->send(new ReplyContact($request->all()));

    }

}
