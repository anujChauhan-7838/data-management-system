<?php
   
namespace App\Jobs;
   
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\AddUpdateUserNotifyEmail;
use Mail;
   
class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
   
    protected $details;
    protected $isAddedUser;
   
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details,$isAddedUser)
    {
        $this->details     = $details;
        $this->isAddedUser = $isAddedUser;
    }
   
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new AddUpdateUserNotifyEmail($this->details,$this->isAddedUser);
        Mail::to($this->details['email'])->send($email);
    }
}