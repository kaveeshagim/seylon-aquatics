<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        'qtyperbag',
        'image',
        'size',
    ];

    public function species()
    {
        return $this->belongsTo(FishSpecies::class, 'species_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size');
    }

     public function fishweekly()
    {
        return $this->hasMany(FishWeekly::class, 'fish_code', 'fish_code');
    }

    public function fishweeklyold()
    {
        return $this->hasMany(FishWeeklyOld::class, 'fish_code', 'fish_code');
    }


     public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
