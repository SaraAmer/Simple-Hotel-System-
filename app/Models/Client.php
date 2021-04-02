<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable =
    [   'id',
        'name',
        'email',
        'password',
        'gender',
        'mobile',
        'country',
        'aprovalID',
        'aprovalRole',
        'has_reservations',
        'avatar_image',
    ];
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];


    public function reservations()
    {
        return $this->belongsTo(Reservation::class, 'client_id');
    }
}
