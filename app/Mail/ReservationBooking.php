<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationBooking extends Mailable
{
    use Queueable, SerializesModels;

    private $reservation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from(config('mail.from.address'), config('app.name'))
            ->subject('Stoney Campgrounds Reservation')
            ->view('email.reservation')
            ->with(['reservation' => $this->reservation]);
    }
}
