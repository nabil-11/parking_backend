<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingPlace extends Model
{
    use HasFactory;
    protected $table = 'parking_places';

    protected $hidden = [

        'id'
    ];
    protected $fillable = [
        'status','bloc_id'
    ];

    public function Bloc(){
        return $this->belongsTo('App\Models\Bloc','bloc_id');
    }
}
