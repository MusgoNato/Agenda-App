<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\TesteMail;

class MailController extends Controller
{
    //
    public function index()
    {
        /*Envio da mensagem ao destinatario*/
        Mail::to('rgm47583@comp.uems.br')->send(new TesteMail([
            'title' => 'Mensagem de Teste',
            'body' => 'Eaí man',
        ]));
    }
}
