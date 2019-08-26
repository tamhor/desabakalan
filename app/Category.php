<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function outcome(){
        return $this->hasMany(Outcome::class, 'out_category', 'id');
    }
}
