<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    protected $table = 'supplies';
    protected $fillable = [
        'name',
        'unit',
    ];
}
