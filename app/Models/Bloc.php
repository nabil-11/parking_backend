<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bloc extends Model
{
    use HasFactory;
    protected $table = 'blocs';

    protected $hidden = [

    ];
    protected $fillable = [
       'id', 'hour_price','type','parking_id'
    ];

    public function blocPlaces(){
        return $this->hasMany('App\Models\ParkingPlace','bloc_id','id');
    }
    public function parking(){
        return $this->hasOne('App\Models\Parking','parking_id','id');
    }
}
