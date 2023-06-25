<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    use HasFactory;
    protected $fillable = [
        'country_name_eng',
        'country_name_bng',
        'nationality_eng',
        'nationality_bng'
    ];
}
