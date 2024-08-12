<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Custom extends Model
{
    protected $fillable = [
        'primary',
        'titulo',
        'logo',
        'background'
    ];
}
