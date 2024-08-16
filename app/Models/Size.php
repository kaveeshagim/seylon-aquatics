<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Size extends Model
{
    use HasFactory;

    protected $table = 'tbl_size';
    public $timestamps = true;
    protected $fillable = ['name', 'description'];

    public function fish()
    {
        return $this->hasMany(Fish::class, 'size');
    }
    public function fishweekly()
    {
        return $this->hasMany(Fish::class, 'size');
    }
    public function fishweeklyold()
    {
        return $this->hasMany(Fish::class, 'size');
    }

    public function variety()
    {
        return $this->hasMany(FishVariety::class, 'size');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
