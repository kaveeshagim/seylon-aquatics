<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAuthLog extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_user_auth_log';

    protected $fillable = [
        'ip_address',
        'user_id',
        'username',
        'description',
        'event',
    ];
}
