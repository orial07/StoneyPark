<?php

namespace App\Mail;

use App\Helper\ReservationUtil;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationBooking extends Mailable
{
    use Queueable, SerializesModels;

    private $reservation;
    private $campers;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reservation, $campers)
    {
        $this->reservation = $reservation;
        $this->campers = $campers;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
            ->subject('Stoney Campgrounds Reservation')
            ->view('email.reservation')
            ->with([
                'reservation' => $this->reservation,
                'campers' => $this->campers,
                'nights' => ReservationUtil::getNights($this->reservation),
                'cost' => ReservationUtil::getCost($this->reservation),
            ]);
    }
}
