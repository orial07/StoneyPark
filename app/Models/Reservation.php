<?php

namespace App\Models;

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
}
