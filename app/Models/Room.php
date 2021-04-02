<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Floor;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'floor_id',
        'capacity',
        'price_inCents',
        'created_at',
        'updated_at',  
    ];
    public function floors()
    {
        return $this->belongsTo('App\Models\Floor', 'floor_id', 'number');
    }
}
