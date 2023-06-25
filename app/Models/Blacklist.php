<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blacklist extends Model
{
    use HasFactory;
    protected $fillable = [
        'complainant_id',
        'office_id',    
        'requested',    
        'blacklisted',    
        'office_name',    
        'reason',       
        'created_by',
        'modified_by',
        'status', 
    ];

    public function complainant_info()
    {
        return $this->belongsTo(Complainant::class, 'complainant_id', 'id');
    }


}
