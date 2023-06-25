<?php

namespace App\Services;

use App\Models\Nationality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class NationalityServices
{
    public function getNationalityInfo(Request $request): array
    {
        try {

            $query = Nationality::query();

            // $query->when($complainant_id, function ($q, $complainant_id) {
            //     return $q->where('complainant_id', $complainant_id);
            // });

            $allNationality = $query->get();

            $data = ['status' => 'success', 'data' => $allNationality];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }





}
