<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintAttachmentMovement extends Model
{
    use HasFactory;
    protected $table = 'complaint_movement_attachments';
    protected $fillable = [
        'complaint_movement_id',
        'file_path',
        'file_type',
        'file_title',
        'created_by',
        'modified_by',
        'status',
        
    ];
}
