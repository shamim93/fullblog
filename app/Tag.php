<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
