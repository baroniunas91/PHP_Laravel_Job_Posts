<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public function postArea()
    {
       return $this->belongsTo('App\Models\Area', 'area_id', 'id');
    }
}
