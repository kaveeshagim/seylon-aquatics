<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'executive',
    ];

}
