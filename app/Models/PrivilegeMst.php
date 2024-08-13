<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class PrivilegeMst extends Model
{
    use HasFactory;
    protected $table = 'tbl_privilege_mst';
    protected $fillable = ['route_name', 'user_type', 'cat_id', 'subcat_id', 'sec_id', 'permission', 'cre_user', 'updated_user'];
    public $timestamps = true;
    
    public function privilegeSection()
    {
        return $this->belongsTo(PrivilegeSection::class, 'sec_id');
    }

    public function privilegeCategory()
    {
        return $this->belongsTo(PrivCategory::class, 'cat_id');
    }

    public function privilegeSubCategory()
    {
        return $this->belongsTo(PrivSubcategory::class, 'subcat_id');
    }


    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
    
}
