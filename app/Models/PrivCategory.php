<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class PrivCategory extends Model
{
    use HasFactory;
    protected $table = 'tbl_priv_category';
    protected $fillable = ['name'];
    public $timestamps = true;

    public function subcategories()
    {
        return $this->hasMany(PrivSubcategory::class, 'cat_id');
    }

     public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
