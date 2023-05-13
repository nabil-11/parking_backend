<?php

namespace App\Http\Controllers;

use App\Models\AbonnementType;
use App\Models\Parking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class responsableController extends Controller
{
    public function showTypeAbonnement(){
        $data = AbonnementType::all();
        return response()->json($data,200) ;
    }

    public function handleResponsableAddParking(Request $request){
        $data = $request->all();
        $resposableId = Auth::user()->id ;
       // Parking::create[name:$data['parking_name'] ];

    }
}
