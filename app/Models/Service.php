<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'office_origin_id',
        'office_origin_unit_id',
        'office_origin_unit_organogram_id',
        'office_origin_name_bng',
        'office_origin_name_eng',
        'service_type',
        'service_name_bng',
        'service_name_eng',
        'service_procedure_bng',
        'service_procedure_eng',
        'documents_and_location_bng',
        'documents_and_location_eng',
        'payment_method_bng',
        'payment_method_eng',
        'service_time',
        'status',
        'created_by',
        'modified_by',
    ];
}
