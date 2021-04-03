<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Cog\Laravel\Ban\Traits\Bannable;

class Receptionist extends Model implements BannableContract
{
    use HasFactory,Bannable;
    protected $fillable = [
        'name', 'email','national_id','avatar_image','updated_at','manger_id'


    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function manager()
    {
        return $this->belongsTo('App\Models\Manager', 'manger_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
