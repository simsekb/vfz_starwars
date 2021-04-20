<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'height', 'mass', 'hair_color', 'skin_color', 'eye_color', 'birth_year', 'gender', 'planet_id', 'species_ids'
    ];

    public function planet() {
        return $this->belongsTo(Planets::class);
    }

    public function species() {
        return $this->belongsToMany(Species::class);
    }
}
