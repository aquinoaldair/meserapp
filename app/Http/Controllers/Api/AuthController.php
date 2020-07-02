<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Customer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        try {
            $request->validate([
                "email" => "email|required",
                "password" => "required",
                'name'  => "required",
            ]);

            $credentials = request(["email", "password"]);

            $data = $request->all();

            $user = DB::transaction(function () use($data) {
                $user = User::create([
                    'email' => $data["email"],
                    'password' =>  $data["password"],
                    'name'      => $data["name"]
                ]);

                $user->assignRole(User::CLIENT_ROLE);

                Client::create([
                    'user_id' => $user->id,
                    'phone_number' => "2281694542"
                ]);
                return $user;
            });

            return response()->json([
                "status_code" => 200,
                "created" => true,
            ]);

        }catch (\Exception $error){
            return response()->json([
                "status_code" => 500,
                "message" => "Error in Register",
                "error" => $error->getMessage(),
            ]);
        }
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                "email" => "email|required",
                "password" => "required"
            ]);

            $credentials = request(["email", "password"]);

            if (!Auth::attempt($credentials)) {

                return response()->json([
                    "status_code" => 500,
                    "message" => "Unauthorized"
                ]);
            }

            $user = User::where("email", $request->email)->first();

            if ( ! Hash::check($request->password, $user->password)) {
                throw new \Exception("Error in Login");
            }

            $tokenResult = $user->createToken("authToken")->plainTextToken;

            return response()->json([
                "status_code" => 200,
                "access_token" => $tokenResult,
                "token_type" => "Bearer",
                'user'  => $user
            ]);


        }catch (\Exception $error){
            return response()->json([
                "status_code" => 500,
                "message" => "Error in Login",
                "error" => $error->getMessage(),
            ]);
        }
    }
}
