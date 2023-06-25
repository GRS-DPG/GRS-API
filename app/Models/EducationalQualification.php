<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalQualification extends Model
{
    use HasFactory;
    protected $fillable = [
        'education_eng',
        'education_bng',
        'status'
    ];
}
