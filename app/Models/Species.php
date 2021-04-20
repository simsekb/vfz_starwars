<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'classification', 'designation', 'average_height', 'skin_colors', 'hair_colors', 'eye_colors', 'average_lifespan', 'planet_id', 'language', 'people_ids'
    ];

    public function people() {
        return $this->belongsToMany(People::class);
    }

    public function planet() {
        return $this->belongsTo(Planets::class);
    }
}
