<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Floor;

class Room extends Model
{
    use HasFactory;
    protected $primaryKey = 'room_number';

    protected $fillable = [
        'floor_id',
        'capacity',
        'price',
        'created_at',
        'updated_at',
       'status'
    ];
    public function floors()
    {
        return $this->belongsTo('App\Models\Floor', 'floor_id', 'number');
    }
}
