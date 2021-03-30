<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'manger_id'
    ];
    public function manager()
    {
        return $this->belongsTo('App\Models\Manager', 'manger_id');
    }
}
