<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    use HasFactory;
    protected $table = 'parkings';

    protected $hidden = [

        'id',
    ];
    protected $fillable = [
        'name','description','responsable_id','langitude','lantitude'
    ];

    public function blocs(){
        return $this->hasMany(Bloc::class,'parking_id','id');
    }
    public function responsable(){
        return $this->belongsTo(Responsable::class,'responsable_id','id');
    }
}
