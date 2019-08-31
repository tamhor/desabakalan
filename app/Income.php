<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{

    protected $fillable = ['in_category','in_balance','in_info'];

    public function category(){
        return $this->belongsTo(Category::class, 'in_category', 'id');
    }

    public function outcome(){
        return $this->hasMany(Outcome::class);
    }
}
