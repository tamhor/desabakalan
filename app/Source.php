<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    public function outcome(){
        return $this->hasMany(Outcome::class, 'source_id', 'id');
    }
    
    public function income(){
        return $this->hasMany(Income::class, 'source_id', 'id');
    }
}
