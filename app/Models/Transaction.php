<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'code',
        'boarding_house_id',
        'room_id',
        'name',
        'email',
        'phone',
        'payment_method',
        'payment_status',
        'start_date',
        'duration',
        'total_amount',
        'transaction_date',
    ];

    public function boardingnHouse() 
    {
        return $this->belongsTo(BoardingHouse::class);
    }

    public function room() 
    {
        return $this->belongsTo(Room::class);
    }
}
