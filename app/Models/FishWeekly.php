<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        'year',
        'month',
        'week',
        'gross_price',
        'quantity',
        'size',
        'size_cm',
        'special_offer',
        'discount',
        'stock_status',
    ];
    public $timestamps = true;

    public function variety()
    {
        return $this->belongsTo(FishVariety::class, 'fish_code', 'fish_code');
    }
    public function sizee()
    {
        return $this->belongsTo(Size::class, 'size');
    }
     public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
