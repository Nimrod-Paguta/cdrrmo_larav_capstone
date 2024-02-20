<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class register extends Model
{
    use HasFactory;
    protected $table = "registers"; 

    protected $fillable = [
        'name',
        'middlename',
        'lastname',
        'barangay',
        'municipality',
        'province',
        'contactnumber',
        'brand',
        'model',
        'vehiclelicense',
        'placard', 
        'color',
        'date',
    ];
}
