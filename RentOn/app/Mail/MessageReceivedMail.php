<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageReceivedMail extends Mailable
{
    use Queueable, SerializesModels;
	protected $sender;
	protected $reciever;
	protected $messageTitle;
	protected $messageText;
    
	/**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sender, $reciever, $messageTitle, $messageText)
    {
        $this->sender = $sender;
        $this->reciever = $reciever;
		$this->messageTitle = $messageTitle;
		$this->messageText = $messageText;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('renton@renton.com')
					->subject("RentOn message from: ".$this->sender)
					->view('messages.show', ['sender' => $this->sender, 'reciever' => $this->reciever, 'messageTitle' => $this->messageTitle, 'messageText' => $this->messageText, 'messageId' => 0]);
		;
    }
}
