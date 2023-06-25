<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complainant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'identification_value',
        'identification_type',
        'mobile_number',
        'email',
        'birth_date',
        'occupation',
        'educational_qualification',
        'gender',
        'username',
        'password',
        'nationality_id',
        'present_address_street',
        'present_address_house',
        'present_address_division_id',
        'present_address_division_name_bng',
        'present_address_division_name_eng',
        'present_address_district_id',
        'present_address_district_name_bng',
        'present_address_district_name_eng',
        'present_address_type_id',
        'present_address_type_name_bng',
        'present_address_type_name_eng',
        'present_address_type_value',
        'present_address_postal_code',
        'is_blacklisted',
        'permanent_address_street',
        'permanent_address_house',
        'permanent_address_division_id',
        'permanent_address_division_name_bng',
        'permanent_address_division_name_eng',
        'permanent_address_district_id',
        'permanent_address_district_name_bng',
        'permanent_address_district_name_eng',
        'permanent_address_type_id',
        'permanent_address_type_name_bng',
        'permanent_address_type_name_eng',
        'permanent_address_type_value',
        'permanent_address_postal_code',
        'foreign_permanent_address_zipcode',
        'foreign_permanent_address_state',
        'foreign_permanent_address_city',
        'foreign_permanent_address_line2',
        'foreign_permanent_address_line1',
        'foreign_present_address_zipcode',
        'foreign_present_address_state',
        'foreign_present_address_city',
        'foreign_present_address_line2',
        'foreign_present_address_line1',
        'is_authenticated',
        'created_by',
        'modified_by',
        'status',
        'present_address_country_id',
        'permanent_address_country_id',
        'blacklister_office_id',
        'blacklister_office_name',
        'blacklist_reason',
        'is_requested'
    ];

    protected $hidden = [
        'password',
    ];
}
