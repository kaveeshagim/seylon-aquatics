<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FishFamily extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

        public function fishSpecies()
    {
        return $this->hasMany(FishSpecies::class, 'family_id');
    }
}
