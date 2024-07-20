<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fish extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_fish';
    public $timestamps = true;

    public function habitat()
    {
        return $this->belongsTo(FishHabitat::class, 'fish_habitat');
    }

    public function variety()
    {
        return $this->belongsTo(FishVariety::class, 'fish_variety');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size');
    }

}
