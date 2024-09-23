<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeHistory extends Model
{
    use HasFactory;

    protected $table = 'exchange_history';

    protected $fillable = [
        'o_currency',
        'd_currency',
        'o_qty',
        'd_qty',
    ];

}
