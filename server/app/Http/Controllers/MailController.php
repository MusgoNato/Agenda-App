<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\TesteMail;

class MailController extends Controller
{
    //
    public function index(Request $request)
    {
        if($request->type=="create"){
            $nome_view = 'teste.mail';
            $details=[
                "name"=>$request->name,
                "codigo"=>$request->codigo,
            ];
        }


        $email = new TesteMail($nome_view, $details);
        
        $email->build();

        Mail::to($request->email)->send($email);
    }
}
