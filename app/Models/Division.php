<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'upper_division',
        'ambassador',
        'count_collaborators'
    ];
}
