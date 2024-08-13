<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

            /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_order_mst';
    public $timestamps = true;
    protected $fillable = [
        'cus_id',
        'order_no',
        'executive_id',
        'status',
        'tot_orders',
        'tot_bags',
        'tot_boxes',
        'advanced_payment',
        'shipping_address',
    ];

    public function executive()
    {
        return $this->belongsTo(User::class, 'executive_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cus_id');
    }

    
    public function order()
    {
        return $this->hasMany(OrderDet::class, 'order_id');
    }

        public function invoice()
    {
        return $this->hasOne(Invoice::class, 'order_id');
    }

        public function invoicedet()
    {
        return $this->hasMany(InvoiceDet::class, 'order_id');
    }

     public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

}
