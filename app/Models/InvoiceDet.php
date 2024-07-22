<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDet extends Model
{
    use HasFactory;
            /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_invoice_det';
    public $timestamps = true;

    protected $fillable = [
        'order_id',
        'invoice_id',
        'orderdet_id',
        'quantity',
        'discount',
        'total_price',
    ];

        public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

        public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

        public function orderdet()
    {
        return $this->belongsTo(OrderDet::class, 'orderdet_id');
    }
}
