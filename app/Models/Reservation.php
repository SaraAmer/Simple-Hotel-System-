<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'client_id',
        'accompany_number',
        'room_number',
        'paid price', 
    ];
}
