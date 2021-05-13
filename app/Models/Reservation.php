<?php

namespace App\Models;

use App\Helper\ReservationUtil;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date_in' => 'datetime',
        'date_out' => 'datetime',
    ];

    public function campers()
    {
        return $this->hasMany(Camper::class);
    }

    public function getCampersCountAttribute() {
        return $this->campers()->count();
    }

    public function getType()
    {
        $i = 0;
        foreach (config('camps.types') as $key => $value) {
            if ($i == $this->camping_type) {
                return $value;
            }
            $i++;
        }
        throw new Exception('Unknown camping type: '. $this->camping_type);
    }

    public function getNights()
    {
        $arrival = strtotime($this->date_in);
        $depature = strtotime($this->date_out);
        return ($depature - $arrival) / 60 / 60 / 24;
    }

    public function getCost($tax = true)
    {
        $ct = $this->getType();
        $cost = $ct['price']; // recurring charges (price per night)
        $cost *= $this->getNights();
        $cost += $ct['price2']; // one-time fee
        if ($tax) $cost *= 1.05; // GST Tax Amount
        return $cost;
    }
}
