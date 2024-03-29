<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $table = "reports"; 

    protected $fillable = [
        'registereduserid',
        'latitude', 
        'longitude', 
        'time',
        'gforce',
        'barangay', 
        'city', 
        'status',
        'month',
        'status', 
    ];
}

