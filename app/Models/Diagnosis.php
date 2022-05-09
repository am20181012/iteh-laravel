<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_of_diagnosis',
        'latin_name',
        'description',
        'cause',
        'hospitalization',
        'note'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function therapies()
    {
        return $this->hasMany(Therapy::class);
    }
}
