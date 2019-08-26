<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    protected $fillable = ['out_category','out_description','out_balance','out_info'];

    public function category(){
        return $this->belongsTo(Category::class, 'out_category', 'id');
    }
}
