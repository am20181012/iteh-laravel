<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Therapy extends Model
{
    use HasFactory;

    protected $fillable = [
        'diagnosis_id',
        'type_of_therapy',
        'name_of_therapy',
        'description'
    ];

    public function diagnosis()
    {
        return $this->belongsTo(Diagnosis::class);
    }
}
