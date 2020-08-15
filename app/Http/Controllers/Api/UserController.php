<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Transformers\UserTransformer;
use Auth;

class UserController extends Controller
{
    public function users(User $user)
    {
      $users = $user->all();

      return fractal()
        ->collection($users) //menggunakan collection untuk menerima banyak value
        ->TransformWith(new UserTransformer)
        ->toArray();

    }

    public function profile(User $user)
    {
      $user = $user->find(Auth::user()->id);

      return fractal()
        ->item($user)
        ->transformWith(new UserTransformer)
        ->includePosts()
        ->toArray();
    }

    public function profileById(User $user, $id)
    {
      $user = $user->find($id);

      return fractal()
        ->item($user)
        ->transformWith(new UserTransformer)
        ->includePosts()
        ->toArray();
    }

}