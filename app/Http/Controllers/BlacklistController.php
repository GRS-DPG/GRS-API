<?php

namespace App\Http\Controllers;
use App\Services\BlacklistServices;
use App\Models\Blacklist;



use Illuminate\Http\Request;

class BlacklistController extends Controller
{
    public function Index(Request $request, BlacklistServices $blacklistServices): \Illuminate\Http\JsonResponse
    {
        $complaintData = $blacklistServices->getBlacklistComplainantInfo($request);

        if (isSuccessResponse($complaintData)) {
            $response = responseFormat('success', $complaintData['data']);
        } else {
            $response = responseFormat('error', $complaintData['data']);
        }

        return response()->json($response);
    }
    public function blacklistStatus(Request $request, BlacklistServices $blacklistServices): \Illuminate\Http\JsonResponse
    {
        $complaintData = $blacklistServices->getblacklistStatus($request);

        if (isSuccessResponse($complaintData)) {
            $response = responseFormat('success', $complaintData['data']);
        } else {
            $response = responseFormat('error', $complaintData['data']);
        }

        return response()->json($response);
    }
    
}
