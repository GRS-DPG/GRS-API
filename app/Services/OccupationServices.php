<?php

namespace App\Services;

use App\Models\Occupation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class OccupationServices
{
    public function getOccupationInfo(Request $request): array
    {
        try {

            $query = Occupation::query();

            // $query->when($complainant_id, function ($q, $complainant_id) {
            //     return $q->where('complainant_id', $complainant_id);
            // });

            $allOccupation = $query->where('status',1)->get();

            $data = ['status' => 'success', 'data' => $allOccupation];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }





}
