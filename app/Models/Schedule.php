<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'barber_id',
        'schedule_date',
        'start_time',
        'end_time',
        'status'
    ];

    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}