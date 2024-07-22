<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FishSpecies extends Model
{
    use HasFactory;
                    /**
     * The table associated with the model.
     *
     * @var string
     */
    
    protected $table = 'tbl_fish_species';
    public $timestamps = true;
    
      protected $fillable = [
        'species_code', 
        'family_id', 
        'name', 
        'scientific_name', 
    ];

    public function family()
    {
        return $this->belongsTo(FishFamily::class, 'family_id');
    }

        public function variety()
    {
        return $this->hasMany(FishVariety::class, 'species_id');
    }
}
