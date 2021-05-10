<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campground extends Model
{
    use HasFactory;

    protected $fillable = ['section', 'number'];

    public function getReservationsAttribute()
    {
        return Reservation::where('campground_id', $this->section . '-' . $this->number);
    }
}
