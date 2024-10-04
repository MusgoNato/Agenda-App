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
        // Criar os detalhes do email
        $details = [
            'title' => 'Olá, Bem Vindo ao aplicativo :).',
            'body' => 'Xandao deitou o Muskzada',
        ];

        // Nome da view
        $nome_view = 'teste.mail';

        // Criar uma nova instância de TesteMail
        $email = new TesteMail($nome_view, $details);
        
        // Chamar o método build manualmente
        $email->build();

        // Envio da mensagem ao destinatário
        Mail::to('rgm47159@comp.uems.br')->send($email);
    }
}
