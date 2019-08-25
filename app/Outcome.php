<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    protected $fillable = ['out_category','out_description','out_balance'];

    public function outcome(){
        return $this->hasMany(Category::class);
    }
}
