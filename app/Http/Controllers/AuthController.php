<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Transformers\UserTransformer;
use Auth;

class AuthController extends Controller
{
    public function register(Request $req, User $users)
    {
      $this->validate($req, [
        'name'    => 'required',
        'email'   => 'required|email|unique:users',
        'password'=> 'required|min:6',
      ]);

      $user = $users->create([
        'name'      => $req->name,
        'email'     => $req->email,
        'password'  => bcrypt($req->password),
        'api_token' => bcrypt($req->email)
      ]);

      $response = fractal()
          ->item($user) //meggunakan item karena value cuman satu baris
          ->TransformWith(new UserTransformer)
          ->addMeta([//digunakan untuk menambah data selain pada transform
            'token' => $user->api_token,
          ])
          ->toArray();

      return response()->json($response,201);
    }

    public function login(Request $req, User $user)
    {
      if(!Auth::attempt(['email' => $req->email,'password' => $req->password])){
        return response()->json(['error'=> 'Your credential is wrong!!'], 401);
      }

      $user = $user->find(Auth::user()->id);

      return fractal()
        ->item($user)//meggunakan item karena value cuman satu baris
        ->transformWith(new UserTransformer)
        ->addMeta([//digunakan untuk menambah data selain pada transform
          'token' => $user->api_token,
        ])
        ->toArray();
    }
}
