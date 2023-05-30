<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    use HasFactory;
    protected $table = 'abonnements';

    protected $hidden = [

        'id'
    ];
    public $fillable = [
        'date_expire' , 'type_abonnement_id'
    ];
    public function responsable(){
        return $this->hasOne(Responsable::class,'abonnement_id','id');
    }
    public function type_abonnement(){
        return $this->hasOne('App\Models\AbonnementType','type_abonnement_id','id');
    }
}
