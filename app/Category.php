<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['source_id','name','balance'];

    public function outcome(){
        return $this->hasMany(Outcome::class, 'out_category', 'id');
    }
    
    public function income(){
        return $this->hasMany(Income::class, 'out_category', 'id');
    }

    public function source(){
        return $this->belongsTo(Source::class, 'source_id', 'id');
    }
}
