<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyObject extends Model
{
    protected $fillable = ['title','description','lat','lon','price_per_day','country_id','state_id','city_id','user_id'];

    protected $appends = ['avgrating'];

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function ratings(){
        return $this->hasMany(Rating::class);
    }

    public function media(){
        return $this->hasMany(Media::class,'object_id','id');
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function state(){
        return $this->belongsTo(State::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function getAvgratingAttribute(){
        return $this->ratings->pluck('rating')->avg();
    }
}
















