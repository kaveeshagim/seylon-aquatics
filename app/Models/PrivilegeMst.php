<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class PrivilegeMst extends Model
{
    use HasFactory;
    protected $table = 'tbl_privilege_mst';
    protected $fillable = ['route_id', 'user_type', 'cat_id', 'subcat_id', 'cre_user', 'updated_user'];
    public $timestamps = true;
    
    public function privilegeSection()
    {
        return $this->belongsTo(PrivilegeSection::class, 'route_id');
    }

    /**
     * Get the category that owns the privilege master.
     */
    public function category()
    {
        return $this->belongsTo(PrivCategory::class, 'cat_id');
    }

    /**
     * Get the subcategory that owns the privilege master.
     */
    public function subcategory()
    {
        return $this->belongsTo(PrivSubcategory::class, 'subcat_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
    
}
