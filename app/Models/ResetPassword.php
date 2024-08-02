<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ResetPassword extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_reset_password';
    public $timestamps = true;
    protected $fillable = [
        'psws_reqid',
        'user_id',
        'username',
        'old_password',
        'new_password',
        'updated_by',
    ];

        public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

        public function passwordreq()
    {
        return $this->belongsTo(ResetPasswordReq::class, 'psws_reqid');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

}
