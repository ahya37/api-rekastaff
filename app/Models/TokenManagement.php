<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenManagement extends Model
{
    use HasFactory;

    protected $table = 'token_management';
    protected $guarded = [];
    
}
