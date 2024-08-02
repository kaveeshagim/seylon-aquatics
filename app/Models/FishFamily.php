<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class FishFamily extends Model
{
    use HasFactory;
    protected $table = 'tbl_fish_family';
    protected $fillable = ['name', 'habitat_id'];
    public $timestamps = true;

    public function habitat()
    {
        return $this->belongsTo(FishHabitat::class, 'habitat_id');
    }

        public function species()
    {
        return $this->hasMany(FishSpecies::class, 'family_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
