<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use Auth;
use App\Transformers\PostTransformer;

class PostController extends Controller
{
    public function add(Request $req, Post $post)
    {
      $this->validate($req, [
        'content'   =>  'required|min:10',
      ]);

      $post = $post->create([
        'user_id'   =>  Auth::user()->id,
        'content'   =>  $req->content,
      ]);

      $response = fractal()
        ->item($post)
        ->transformWith(new PostTransformer)
        ->toArray();

      return response()->json($response, 201);
    }

    public function update(Request $req, Post $post)
    {
      //memanggil fungsi mengecek kecocokan post dan user
      $this->authorize('update', $post);
      //maksudnya, apabila request kosong maka akan digunakan data dari table post untuk
      //mengisi lagi. INTINYA VALUE TETEP SAMA.
      $post->content = $req->get('content', $post->content);
      $post->save();

      return fractal()
        ->item($post)
        ->transformWith(new PostTransformer)
        ->toArray();
    }

    public function delete(Post $post)
    {
      $this->authorize('delete', $post);

      $post->delete();

      return response()->json([
        'message' => 'Post Deleted!!',
      ]);
    }
}
