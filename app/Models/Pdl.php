<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pdl extends Model
{
    protected $fillable = [
        'facility_id',
        'first_name',
        'last_name',
        'cell_block',
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
