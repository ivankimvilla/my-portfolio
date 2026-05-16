<?php

namespace App\Mail;

use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InquiryReceived extends Mailable
{
    use Queueable, SerializesModels;

    public Inquiry $inquiry;

    public function __construct(Inquiry $inquiry)
    {
        $this->inquiry = $inquiry;
    }

    public function build()
    {
        return $this->from(
                        config('mail.from.address'),
                        config('mail.from.name')
                    )
                    ->subject('Ivan kim almadin inquiry recieved please')
                    ->view('emails.inquiry-received')
                    ->with(['inquiry' => $this->inquiry]);
    }
}
