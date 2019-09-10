<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    protected $fillable = ['source_id','out_category','out_description','out_balance','out_info'];

    public function source(){
        return $this->belongsTo(Source::class, 'source_id', 'id');
    }
    public function income(){
        return $this->hasMany(Income::class);
    }
}
