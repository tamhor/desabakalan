<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{

    protected $fillable = ['source_id', 'in_category','in_description','in_balance','in_info'];

    public function source(){
        return $this->belongsTo(Source::class, 'source_id', 'id');
    }

    public function outcome(){
        return $this->hasMany(Outcome::class);
    }
}
