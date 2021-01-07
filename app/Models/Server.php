<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Models\User;
use App\Models\Vote;
use App\Models\Comment;

class Server extends Model
{
    use HasSlug;
    use HasFactory;
    protected $guarded = [];



    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function vote(){
        return $this->hasMany(Vote::class, 'server_id');
    }

    public function comment(){
        return $this->hasMany(Comment::class, 'server_id');
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
