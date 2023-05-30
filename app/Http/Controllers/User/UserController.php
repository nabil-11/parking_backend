<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Abonnement;
use App\Models\AbonnementType;
use App\Models\client;
use App\Models\Responsable;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function handleUserRegister(Request $request){
        // Validate the input data
        $validator = Validator::make($request->all(), [

            'firstName' => 'required|string|max:30',
            'lastName' => 'required|string|max:30',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'picture' => 'nullable|string|max:60',
            'phone' => 'nullable|string|max:20',
            'confirmPassword' => 'required|string|same:password',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
      $client = Client::create();

        // Create a new user using the validated data
        $user = User::create([
            'first_name' => $request->input('firstName'),
            'last_name' => $request->input('lastName'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'picture' => $request->input('picture'),
            'role_id'=> 1 ,
            'phone' => $request->input('phone'),
            'client_id'=>$client->id
        ]);


        // Optionally, you can perform additional actions like sending a welcome email or generating an authentication token

        // Return a success response
        return response()->json(['message' => 'Registration successful', 'user' => $user], 201);

    }
    public function handleUserLogin(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)
                ->with(['responsable' => function ($query) {
                    $query->with('abonnement');
                }])
                ->first();


            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken ,
                'user'=> $user
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function handleUserAddPayment(Request $request){
   $data = $request->all() ;
    $user = Auth::user() ;
     if(isset($user->responsable_id)){
         $responsable = Responsable::find($user->responsable_id);
         $ab = Abonnement::find($responsable->abonnement_id);
         if($data['type']==2){
             $ab->date_expire =  Carbon::parse($ab->date_expire)->addYear();
         }else{
             $ab->date_expire =  Carbon::parse($ab->date_expire)->addMonth();
         }
         $ab->save();
         return response()->json(['status'=>true , $ab] ,200);


     }else{

           $now = Carbon::now();
         if($data['type']==1){
             $date_exp =$now->addMonth() ;
         }
         if($data['type']==2){
             $date_exp =$now->addYear() ;
         }
            $ab = Abonnement::create([
                'type_abonnement_id'=>$data['type'],
                'date_expire'=>$date_exp
            ]) ;
         $resp =  Responsable::create([
             'abonnement_id'=>$ab->id
         ]);
         $user->responsable_id = $resp->id;

 return response()->json([$resp,$ab] ,201);
     }


    }

}
