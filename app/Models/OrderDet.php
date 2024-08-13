<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OrderDet extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_order_det';
    public $timestamps = true;

    protected $fillable = [
        'order_id',
        'order_no',
        'fish_code',
        'size',
        'per_bag',
        'orders',
        'bags',
        'boxes',
        'approval_status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function invoicedet()
    {
        return $this->hasMany(InvoiceDet::class, 'orderdet_id');
    }

     public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
