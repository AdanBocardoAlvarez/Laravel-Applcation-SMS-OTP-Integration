<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessPlan extends Model
{  protected $casts = [

    'date' => 'datetime',
];
    use HasFactory;
}
