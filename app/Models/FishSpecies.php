<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FishSpecies extends Model
{
    use HasFactory;
      protected $fillable = [
        'species_code', 
        'family_id', 
        'name', 
        'scientific_name', 
    ];

    public function family()
    {
        return $this->belongsTo(FishFamily::class);
    }
}
