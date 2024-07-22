<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_users';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'tbl_usertype_id',
        'fname',
        'lname',
        'company',
        'active_status',
        'email',
        'primary_contact',
        'secondary_contact',
        'token',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user type associated with the user.
     */
    public function userType()
    {
        return $this->belongsTo(UserType::class, 'tbl_usertype_id');
    }

    public function authlog() {
        return $this->hasMany(UserAuthLog::class, 'user_id');
    }

    public function customer() {
         return $this->hasMany(Customer::class, 'executive_id');
    }

    public function notification()
    {
        return $this->hasMany(FishVariety::class, 'user_id');
    }

    public function passwordreq()
    {
        return $this->hasMany(ResetPasswordReq::class, 'user_id');
    }

        public function passwordreqrec()
    {
        return $this->hasMany(ResetPassword::class, 'user_id');
    }

        public function order()
    {
        return $this->hasMany(Order::class, 'executive_id');
    }
}
