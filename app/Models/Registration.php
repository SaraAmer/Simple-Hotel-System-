<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'name',
        'email',
        'password',
        'gender',
        'mobile',
        'country',

    ];
     // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];
}
