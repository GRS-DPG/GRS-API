<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintMovement extends Model
{
    use HasFactory;
    protected $table = 'complaint_movements';

    protected $fillable = [
        'complaint_id',
        'note',
        'action',
        'to_employee_record_id',
        'from_employee_record_id',
        'to_office_unit_organogram_id',
        'from_office_unit_organogram_id',
        'to_office_id',
        'from_office_id',
        'to_office_unit_id',
        'from_office_unit_id',
        'is_current',
        'is_cc',
        'is_committee_head',
        'is_committee_member',
        'to_employee_name_bng',
        'from_employee_name_bng',
        'to_employee_name_eng',
        'from_employee_name_eng',
        'to_employee_designation_bng',
        'from_employee_designation_bng',
        'to_office_name_bng',
        'from_office_name_bng',
        'to_employee_unit_name_bng',
        'from_employee_unit_name_bng',
        'from_employee_username',
        'created_by',
        'modified_by',
        'status',
        'deadline_date',
        'current_status',
        'is_seen',
        'assigned_role'
    ];


    public function complaint_movement_info()
    {
        return $this->belongsTo(Complaint::class, 'complaint_id', 'id');
    }

    public function complain_movement_attachment()
    {
        return $this->hasMany(ComplaintAttachmentMovement::class, 'complaint_movement_id', 'id');
    }
}
