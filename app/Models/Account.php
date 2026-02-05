<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $fillable = [
        'shop_id',
        'date',
        'sell',
        'market',
        'visacard',
        'snacks',
        'drivar_bill',
        'others',
        'created_by',
        'updated_by',
    ];
}
