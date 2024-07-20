<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\OrderStatusChanged;

class TestOrder extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];
    protected $table = 'testorders';
    public $timestamps = true;

    protected $dispatchesEvents = [
        'updated' => OrderStatusChanged::class,
    ];
}
