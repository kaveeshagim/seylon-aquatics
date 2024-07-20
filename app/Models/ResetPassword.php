<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
