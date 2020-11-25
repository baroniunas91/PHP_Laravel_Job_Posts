<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    public function areaPosts()
    {
       return $this->hasMany('App\Models\Post', 'area_id', 'id');
    }
}
