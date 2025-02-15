<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $guarded =[];

    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }
}
