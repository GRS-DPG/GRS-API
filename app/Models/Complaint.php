<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'submission_date',
        'submission_date_bn',
        'complaint_type',
        'complaint_type_bn',
        'current_status',
        'current_status_bn',
        'subject',
        'details',
        'tracking_number',
        'tracking_number_bn',
        'complainant_id',
        'is_grs_user',
        'office_id',
        'service_id',
        'service_id_before_forward',
        'current_appeal_office_id',
        'current_appeal_office_unit_organogram_id',
        'send_to_ao_office_id',
        'is_anonymous',
        'case_number',
        'other_service',
        'other_service_before_forward',
        'service_receiver',
        'service_receiver_relation',
        'gro_decision',
        'gro_identified_complaint_cause',
        'gro_suggestion',
        'ao_decision',
        'ao_identified_complaint_cause',
        'ao_suggestion',
        'created_by',
        'modified_by',
        'status',
        'rating',
        'appeal_rating',
        'is_rating_given',
        'is_appeal_rating_given',
        'feedback_comments',
        'appeal_feedback_comments',
        'source_of_grievance',
        'is_offline_complaint',
        'is_self_motivated_grievance',
        'uploader_office_unit_organogram_id',
    ];

    public function complainant_info()
    {
        return $this->belongsTo(Complainant::class, 'complainant_id', 'id');
    }
     public function complaint_attachment_info()
    {
        return $this->belongsTo(ComplaintAttachment::class, 'id', 'complaint_id');
    }
    public function complaint_movement_info()
    {
        return $this->belongsTo(ComplaintMovement::class, 'id', 'complaint_id');
    }
}
