<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FishHabitat extends Model
{
    use HasFactory;

            /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_fishhabitat';
    public $timestamps = true;

    public function fishh()
    {
        return $this->hasMany(Fish::class, 'fish_habitat');
    }
}
