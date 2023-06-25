<?php

namespace App\Services;

use App\Models\EducationalQualification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class EducationalQualificationServices
{
    public function getEducationalQualificationInfo(Request $request): array
    {
        try {

            $query = EducationalQualification::query();

            // $query->when($complainant_id, function ($q, $complainant_id) {
            //     return $q->where('complainant_id', $complainant_id);
            // });

            $allEducationalQualification = $query->where('status',1)->get();

            $data = ['status' => 'success', 'data' => $allEducationalQualification];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }





}
