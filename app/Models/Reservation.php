<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $table = 'reservations';

    protected $fillable=[
        'id','start_date','end_date','code_reservation','score','client_id','place_parking_id'
    ];
}
