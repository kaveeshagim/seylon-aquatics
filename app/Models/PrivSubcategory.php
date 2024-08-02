<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PrivSubcategory extends Model
{
    use HasFactory;
    protected $table = 'tbl_priv_subcategory';
    protected $fillable = ['cat_id', 'name'];
    public $timestamps = true;
    
    public function category()
    {
        return $this->belongsTo(PrivCategory::class, 'cat_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
