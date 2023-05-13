<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
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

        // Create a new user using the validated data
        $user = User::create([
            'first_name' => $request->input('firstName'),
            'last_name' => $request->input('lastName'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'picture' => $request->input('picture'),
            'role_id'=> 1 ,
            'phone' => $request->input('phone'),
        ]);

        // Optionally, you can perform additional actions like sending a welcome email or generating an authentication token

        // Return a success response
        return response()->json(['message' => 'Registration successful', 'user' => $user], 201);

    }
    public function handleUserLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            // Validation failed
            return response()->json(['message' => 'Invalid input'], 422);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed
            return response()->json(['message' => 'Login successful']);
        } else {
            // Authentication failed
            return response()->json(['message' => 'Invalid email'], 401);
        }
    }
}
