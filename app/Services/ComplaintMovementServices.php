<?php

namespace App\Services;

use App\Models\ComplaintMovement;
use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ComplaintMovementServices
{
    public function getComplaintMovementInfo(Request $request): array
    {
        try {
            $to_employee_record_id = $request->to_employee_record_id;

            $query = ComplaintMovement::query();
            $query->when($to_employee_record_id, function ($q, $to_employee_record_id) {
                return $q->where('to_employee_record_id', $to_employee_record_id);
            });

            $result = $query->with('complaint_movement_info')->get();

            $data = ['status' => 'success', 'data' => $result];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;

    }


}
