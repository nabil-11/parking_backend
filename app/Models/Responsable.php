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
        'abonnement_id'
    ];
    public function abonnement(){
        return $this->belongsTo(Abonnement::class, 'abonnement_id');
    }
    public function parking(){
        return $this->hasMany('App\Models\Parking','responsable_id','id');
    }
    public function user(){
        return $this->hasOne(User::class,'responsable_id','id');

    }


}
