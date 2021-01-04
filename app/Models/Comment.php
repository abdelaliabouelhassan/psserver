<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function replay()
    {
        return $this->hasMany('App\Models\Replay', 'comment_id');
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
