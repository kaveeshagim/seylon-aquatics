<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PrivilegeSection extends Model
{
    use HasFactory;
    protected $table = 'tbl_privilege_section';
    protected $fillable = ['cat_id', 'subcat_id', 'route_name', 'section_name', 'cre_user'];
    public $timestamps = true;
    
    public function category()
    {
        return $this->belongsTo(PrivCategory::class, 'cat_id');
    }

    /**
     * Get the subcategory that owns the privilege section.
     */
    public function subcategory()
    {
        return $this->belongsTo(PrivSubcategory::class, 'subcat_id');
    }

    /**
     * Get the privilege master records for the privilege section.
     */
    public function privilegeMsts()
    {
        return $this->hasMany(PrivilegeMst::class, 'route_id');
    }

     public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
