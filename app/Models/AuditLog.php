<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_name',
        'table_row_id',
        'old_data',
        'new_data',
        'responsible_user_id',
        'action_type',
        'entity_id',
        'institute_info_id',
        'tranche',
        'bill_sequence_no',
    ];

    public function user_info()
    {
        return $this->belongsTo(User::class,'responsible_user_id','id');
    }
}
