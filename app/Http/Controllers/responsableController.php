<?php

namespace App\Http\Controllers;

use App\Models\AbonnementType;
use App\Models\Bloc;
use App\Models\Parking;
use App\Models\ParkingPlace;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Event\Code\Throwable;

class responsableController extends Controller
{
    public function showTypeAbonnement(){
        $data = AbonnementType::all();
        return response()->json($data,200) ;
    }
  public function showAllParking(){
      $parkings = Parking::
          with('blocs')
          ->get();
      return  response()->json([
          'status'=>true ,
          'data'=>$parkings
      ],200);
  }

  public function handleReservation(Request $request){
$data = $request->all();
 $blocId = $data['blocId'] ;
  $bloc= Bloc::where('id', $blocId)->with('blocPlaces')->get();
      $hoursToAdd = $data['numberOfHours'];

  $reservation = Reservation::create([
      'start_date'=> Carbon::parse($data['dateTime']),
      'end_date'=>Carbon::parse($data['dateTime'])->addHours($hoursToAdd),
      'code_reservation'=>mt_rand(100000, 999999),
      'score'=>'1',
      'client_id'=>Auth::user()->client_id,
      'place_parking_id'=>1

  ]);
  return response()->json($reservation,200) ;
  }
  public function listReservation(){
        $list_reservation = Reservation::where('client_id',Auth::user()->client_id)->get();
        return response()->json($list_reservation,200) ;
  }
    public function showResponsableParking(){
        $user = Auth::user() ;
        $parkings = Parking::where('responsable_id',$user->responsable_id)
            ->with('blocs')
            ->get();
        return  response()->json([
         'status'=>true ,
         'data'=>$parkings
        ],200);
    }
    public function handleUserDeleteParking($id){
        Parking::where('id', $id)->delete();
        return  response()->json(['message'=>'parking was deleted '],200) ;
    }
    public function handleResponsableAddParking(Request $request){
        try{



            $data = $request->all();
            $user =Auth::user() ;
            // $userId = Auth::user()->id ;
            $Parking = Parking::create([
                'name' => $data['parkingName'] ,
                'langitude'=>$data['langitude'] ,
                'lantitude'=>$data['lantitude'],
                'description'=> $data['description'] ,
                'responsable_id'=>$user->responsable_id
            ]);
            foreach ($data['blocsForm'] as $bloc){
                $ParkingBloc = Bloc::create(['hour_price'=>$bloc['price'] , 'type' =>$bloc['type'],'parking_id'=>$Parking['id'] ]) ;

                for ($i = 0; $i < $bloc['place_number']; $i++) {
                    ParkingPlace::create(['status'=>1 , 'bloc_id'=>$ParkingBloc['id']]) ;
                }
            }
            return response()->json([
                'status'=>true , 'message'=> 'parking created successfully'
            ],200) ;
        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

}
