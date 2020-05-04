<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    protected $table = 'stocks';
    protected $fillable = [
        'supply_id',
        'brand',
        'unit',
        'qty',
        'type',
        'date_expiration'
    ];
}
