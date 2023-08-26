<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'posts';

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function thumbnail()
    {
        return $this->hasOne(Media::class, 'model_id', 'id')->where('model_type', 'LaraZeus\Sky\Models\Post');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'taggables', 'taggable_id', 'tag_id');
    }
}
