<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class PrivilegeMst extends Model
{
    use HasFactory;
    protected $table = 'tbl_privilege_mst';
    protected $fillable = ['route_id', 'user_type', 'sec_id', 'cre_user', 'updated_user'];
    public $timestamps = true;
    
    public function privilegeSection()
    {
        return $this->belongsTo(PrivilegeSection::class, 'sec_id');
    }


    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
    
}
