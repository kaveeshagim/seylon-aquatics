<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Invoice extends Model
{
    use HasFactory;
            /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_invoice_mst';
    public $timestamps = true;

    protected $fillable = [
        'order_id',
        'gross_total',
        'final_total',
        'shipment_date',
        'invoice_no',
        'order_no',
        'discount_total',
        'handling_fee',
        'packaging_fee',
        'shipment_date',	
        'shipping_cost'	,
        'payment_status',	
        'invoice_status'	

    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function invoicedet()
    {
        return $this->hasMany(InvoiceDet::class, 'invoice_id');
    }
     public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

}
