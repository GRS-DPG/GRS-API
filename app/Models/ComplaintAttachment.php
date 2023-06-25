<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ComplaintAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'complaint_id',
        'file_path',
        'file_type',
        'file_title',
        'created_by',
        'modified_by',
        'status',
       
    ];

}
