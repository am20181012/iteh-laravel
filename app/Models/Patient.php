<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_num',
        'name',
        'date_of_birth',
        'gender',
        'adress',
        'email'
    ];
}
