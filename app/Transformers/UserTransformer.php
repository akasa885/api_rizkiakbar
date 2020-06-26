<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;
use App\Transformers\PostTransformer;

class UserTransformer extends TransformerAbstract
{
  protected $availableIncludes = [
    'posts'
  ];

  public function transform(User $user)
  {
    return[
      'id'            => $user->id,
      'name'          => $user->name,
      'email'         => $user->email,
      'registered'    => $user->created_at->diffForHumans(),
    ];
  }

  public function includePosts(User $user)
  {
    //alur, memanggil fungsi posts di user
    //masuk ke class posts, lalu memanggil latesfirst pada class posts
    //sbelum mengembalikan hasil
    $posts   =  $user->posts()->latestfirst()->get();

    return $this->collection($posts, new PostTransformer);
  }
}

 ?>
