<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $table = 'tbl_size';
    public $timestamps = true;
    protected $fillable = ['name', 'description'];

    public function fishs()
    {
        return $this->hasMany(Fish::class, 'size');
    }
}
