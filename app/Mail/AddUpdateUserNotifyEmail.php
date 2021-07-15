<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AddUpdateUserNotifyEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $details;
    protected $isAddedUser; 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details,$isAddedUser)
    {
        $this->details     = $details;
        $this->isAddedUser = $isAddedUser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.addUpdateUserMail',['data'=>$this->details,'isAddedUser'=>$this->isAddedUser]);
    }
}
