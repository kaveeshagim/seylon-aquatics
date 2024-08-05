<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Customer extends Model
{
    use HasFactory;
        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_customers';
    public $timestamps = true;

    protected $fillable = [
        'title',
        'fname',
        'lname',
        'company',
        'country',
        'email',
        'primary_contact',
        'secondary_contact',
        'executive_id',
    ];

        public function executive()
    {
        return $this->belongsTo(User::class, 'executive_id');
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'cus_id');
    }

     public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
    
}
