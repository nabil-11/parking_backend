<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    use HasFactory;
    protected $table = 'abonnements';

    protected $hidden = [

        'id','type_abonnement_id'
    ];
    protected $fillable = [
        'date_expire'
    ];
    public function responsable(){
        return $this->belongsTo('App\Models\Responsable','abonnement_id','id');
    }
    public function type_abonnement(){
        return $this->hasOne('App\Models\AbonnementType','type_abonnement_id','id');
    }
}
