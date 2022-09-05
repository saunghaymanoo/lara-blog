<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory,SoftDeletes;
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function photos(){
        return $this->hasMany(Photo::class);
    }
    //local scope
    public function scopeSearch($query){
        return $query->when(request('keyword'),function($q){
            $keyword = request('keyword');
            $q->orWhere('title','like',"%$keyword%")
              ->orWhere('description','like',"%$keyword%");
        });
    }
    protected $with = ['photos','user'];

    //accessor & mutator
    // public function getTitleAttribute($value){
    //     return strtoupper($value);
    // }
    public function setTitleAttribute($value){
        $this->attributes['title'] = strtoupper($value);
    }
    protected static function booted()
    {
        static::created(function ($user) {
            logger($user->name. "created post");
        });
    }
}
