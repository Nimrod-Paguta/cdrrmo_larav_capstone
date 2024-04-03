<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Register;

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
            'status',
            'month',
            'barangay',
            'city',
            'address'
    ];

    public function registereduserid()
    {
        return $this->belongsTo(Register::class, 'registereduserid');
    }

}

