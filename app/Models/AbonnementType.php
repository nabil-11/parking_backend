<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbonnementType extends Model
{
    use HasFactory;
    protected $table = 'type_abonnements';

    protected $hidden = [

        'id'
    ];
    protected $fillable = [
        'price'
    ];
    public function abonnement(){
        return $this->belongsTo('App\Models\Abonnement','type_abonnement_id','id');
    }
   
}
