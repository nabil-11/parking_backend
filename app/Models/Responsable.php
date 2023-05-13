<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    use HasFactory;
    protected $table = 'responsables';

    protected $hidden = [

        'id','abonnement_id'
    ];
    protected $fillable = [
        'picture'
    ];
    public function abonnement(){
        return $this->hasOne('App\Models\Abonnement','abonnement_id','id');
    }
 

}
