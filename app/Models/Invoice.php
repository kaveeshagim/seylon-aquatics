<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function invoicedet()
    {
        return $this->hasMany(InvoiceDet::class, 'invoice_id');
    }

}
