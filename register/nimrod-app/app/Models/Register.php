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
        'emergencynumber',
        'medicalcondition',
        'brand',
        'model',
        'vehiclelicense',
        'color',
        'type',
        'gender', 
        'email', 
        'password',
        
      
        
    ];

        public function users()
    {
        return $this->hasMany(User::class, 'register_id', 'id')->cascadeDelete();
    }
}
