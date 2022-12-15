<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelTestUser extends Model
{
    protected $fillable = ['Name',
                            'Email', 
                            'Password', 
                            'Status', 
                            'Role', 
                        ]; 
    use HasFactory;
}
