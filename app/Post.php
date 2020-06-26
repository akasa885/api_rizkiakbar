<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Post extends Model
{
    protected $fillable = [
      'user_id', 'content'
    ];

    //memakai scope, untuk kemungkinan panggilan berkali-kali
    //untuk memanggil function scope, tidak perlu menulis kata 'scope', dan
    //tidak caseSensitive
    public function scopeLatestFirst($query)
    {
      return $query->orderBy('id','DESC');
    }

    //mencari post berdasar user
    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
