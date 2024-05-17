<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApsUser extends Model
{
    use HasFactory;

    protected $table = 'aps_user';
    protected $guarded = [];
}
