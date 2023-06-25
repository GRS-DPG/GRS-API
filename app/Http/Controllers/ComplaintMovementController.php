<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ComplaintMovement;
use App\Services\ComplaintMovementServices;

class ComplaintMovementController extends Controller
{
    public function List(Request $request, ComplaintMovementServices $complaintMovementServices): \Illuminate\Http\JsonResponse
    {
        $complaintMovementData = $complaintMovementServices->getComplaintMovementInfo($request);

        if (isSuccessResponse($complaintMovementData)) {
            $response = responseFormat('success', $complaintMovementData['data']);
        } else {
            $response = responseFormat('error', $complaintMovementData['data']);
        }

        return response()->json($response);
    }

}
