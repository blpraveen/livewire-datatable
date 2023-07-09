<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['name','category_id'];
    public function category(){
        return $this->hasOne('App\Models\Category','id','category_id');
    }
}
