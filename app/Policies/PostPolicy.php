<?php

namespace App\Policies;

use App\User;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    //fungsi pengecekan authorisasi saat ini, apakah yang memiliki post yang diminta
    public function update(User $user, Post $post)
    {
      return $user->ownsPost($post);
    }

    public function delete(User $user, Post $post){
      return $user->ownsPost($post);
    }
}
