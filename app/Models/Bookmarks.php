<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Bookmarks extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'bookmarks';

    public function b_post()
    {
        return $this->belongsTo(Post::class);
    }

    public function b_user()
    {
        return $this->belongsTo(User::class, 'b_user_id');
    }
}
