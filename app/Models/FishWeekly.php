<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FishWeekly extends Model
{
    use HasFactory;

            /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_fishweekly';
        protected $fillable = [
        'fish_code', 
        'family_id', 
        'name', 
        'scientific_name', 
    ];

    public $timestamps = true;
}
