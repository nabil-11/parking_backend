<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    use HasFactory;
    protected $table = 'responsables';

    protected $hidden = [

        'id'
    ];
    protected $fillable = [
        'picture','abonnement_id'
    ];
    public function abonnement(){
        return $this->hasOne('App\Models\Abonnement','abonnement_id','id');
    }
    public function parking(){
        return $this->hasMany('App\Models\Parking','responsable_id','id');
    }


}
