<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\View\ViewName;
use Tymon\JWTAuth\Providers\Auth\Illuminate;
use Illuminate\Mail\Mailables\Address;

class TesteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $viewname;
    /**
     * Create a new message instance.
     */
    public function __construct($viewname, $details)
    {
        // 
        $this->details = $details;
        $this->viewname = $viewname;
    }

    public function build()
    {
        return $this->subject($this->details['title'])
                    ->view($this->viewname) // Usa a view Blade
                    ->with('title', $this->details['title'])
                    ->with('body', $this->details['body']);
    }   

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Teste Mail',
            from: new Address('test@mail.dev', 'Test Mail')
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            /*O mesmo nome deve ser dado ao que esta na pasta views, o arquivo
            deste caso seria teste-mail.blade.php*/
            view: 'teste-mail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
