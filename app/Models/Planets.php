<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planets extends Model
{
    use HasFactory;

    public function people() {
        return $this->belongsToMany(People::class);
    }
}
