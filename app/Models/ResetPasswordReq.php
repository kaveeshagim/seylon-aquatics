<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ResetPasswordReq extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_reset_password_req';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'reason',
        'new_password',
        'status',
        'email_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function passwordreqrec()
    {
        return $this->hasMany(ResetPassword::class, 'psws_reqid');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
