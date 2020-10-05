<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\OauthClients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\ClientRepository;


class AuthController extends Controller
{
    public function register(Request $request,ClientRepository $clientRepository)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|max:55|unique:users',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);
            
        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);
        
        $accessToken = $user->createToken($validatedData['email'])->accessToken;

       $oauth_client =$clientRepository->createPasswordGrantClient($user->id, 'TestingUser', 'https://example.com');

        // $token_personal = DB::table('oauth_access_tokens')->where('name', $user->email)->first();
        return response([ 'user' => $user,"personal_token"=>$oauth_client->secret, 'access_token' => $accessToken]);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
        // $credentials = $request->only('email', 'password');
        // if (Auth::guard('web')->attempt($credentials)) {
        //     return response(['message' => 'Invalid Credentials']);
        // }
        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials']);
        }
        // return response(["hola"=> "error"]);
        
        return response(['user' => auth()->user()]);

    }

    public function Tokes(Request $request)
    {
    //    return response(['tokes'=> Auth::user()->token() ]);
    }
}
