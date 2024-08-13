<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'ggr',
        'bonus',
        'rate',
        'depositAmount',
        'bonusAmount',
        'total',
        'increased',
        'status'
    ];
}
