<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCustomer extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_subcustomers';
    public $timestamps = true;
    protected $fillable = [
        'title',
        'cus_id',
        'fname',
        'lname',
        'company',
        'country',
        'email',
        'primary_contact',
        'secondary_contact',
    ];
}
