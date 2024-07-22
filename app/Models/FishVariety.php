<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FishVariety extends Model
{
    use HasFactory;

            /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_fish_variety';
    public $timestamps = true;

    protected $fillable = [
        'fish_code', 
        'species_id', 
        'common_name', 
        'scientific_name', 
        'size_cm', 
        'size',
    ];

    public function species()
    {
        return $this->belongsTo(FishSpecies::class, 'species_id');
    }
}
