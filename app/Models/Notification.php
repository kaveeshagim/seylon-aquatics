<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Notification extends Model
{
    use HasFactory;

                /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_notifications';
    public $timestamps = true;

    protected $fillable = [
        'user_id', 
        'notification', 
    ];

        public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

     public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
