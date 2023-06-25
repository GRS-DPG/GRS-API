<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficesGro extends Model
{
    use HasFactory;
    protected $fillable = [
        'office_origin_id',
        'office_id',
        'office_name_bng',
        'office_name_eng',
        'gro_office_id',
        'gro_office_unit_organogram_id',
        'ao_office_id',
        'ao_office_unit_organogram_id',
        'office_admin_office_id',
        'office_admin_office_unit_organogram_id',
        'gro_office_unit_name',
        'ao_office_unit_name',
        'admin_office_unit_name',
        'status',
        'is_ao',
        'custom_layer_id',
        'layer_level',
        'office_ministry_id',
        'office_layer_id',
        'custom_layer_level'
    ];
}
