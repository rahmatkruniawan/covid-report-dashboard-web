<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $view, $content, $notes = null)
    {
        $this->name = $name;
        $this->view = $view;
        $this->content = $content;
        $this->notes = $notes;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('bantulaporcovid@gmail.com')
            ->subject('Lapor Covid')
            ->view($this->view)
            ->with(
            [
                'name' => $this->name,
                'content' => $this->content,
                'notes' => $this->notes
            ]);
    }
}
