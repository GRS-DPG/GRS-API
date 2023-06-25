<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Services\ComplaintServices;
use App\Services\DoptorApiServices;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ComplaintServices $complaintServices): \Illuminate\Http\JsonResponse
    {
        $complaintData = $complaintServices->getComplaintInfo($request);

        if (isSuccessResponse($complaintData)) {
            $response = responseFormat('success', $complaintData['data']);
        } else {
            $response = responseFormat('error', $complaintData['data']);
        }

        return response()->json($response);
    }


    public function save(Request $request, ComplaintServices $complaintServices): \Illuminate\Http\JsonResponse
    {
        $complaintData = $complaintServices->save($request);

        if (isSuccessResponse($complaintData)) {
            $response = responseFormat('success', $complaintData['data']);
        } else {
            $response = responseFormat('error', $complaintData['data']);
        }
        return response()->json($response);
    }

    public function savePublicGrievance(Request $request, ComplaintServices $complaintServices): \Illuminate\Http\JsonResponse
    {
        $complaintData = $complaintServices->savePublicGrievance($request);

        if (isSuccessResponse($complaintData)) {
            $response = responseFormat('success', $complaintData['data']);
        } else {
            $response = responseFormat('error', $complaintData['data']);
        }
        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ComplaintServices $complaintServices): \Illuminate\Http\JsonResponse
    {
        $complaintDetailsData = $complaintServices->getComplaintDetails($request);

        if (isSuccessResponse($complaintDetailsData)) {
            $response = responseFormat('success', $complaintDetailsData['data']);
        } else {
            $response = responseFormat('error', $complaintDetailsData['data']);
        }

        return response()->json($response);
    }
    public function movementHistory(Request $request, ComplaintServices $complaintServices): \Illuminate\Http\JsonResponse
    {
        $complaintDetailsData = $complaintServices->getComplaintMovementInfo($request);

        if (isSuccessResponse($complaintDetailsData)) {
            $response = responseFormat('success', $complaintDetailsData['data']);
        } else {
            $response = responseFormat('error', $complaintDetailsData['data']);
        }

        return response()->json($response);
    }
    public function grievanceTrack(Request $request, ComplaintServices $complaintServices): \Illuminate\Http\JsonResponse
    {
        // echo "hii"; exit();
        $complaintDetailsTrackData = $complaintServices->getGrievanceTrack($request);

        if (isSuccessResponse($complaintDetailsTrackData)) {
            $response = responseFormat('success', $complaintDetailsTrackData['data']);
        } else {
            $response = responseFormat('error', $complaintDetailsTrackData['data']);
        }

        return response()->json($response);
    }
    public function actionHistory(Request $request, ComplaintServices $complaintServices): \Illuminate\Http\JsonResponse
    {
        $complaintHistoryData = $complaintServices->getComplaintHistory($request);

        if (isSuccessResponse($complaintHistoryData)) {
            $response = responseFormat('success', $complaintHistoryData['data']);
        } else {
            $response = responseFormat('error', $complaintHistoryData['data']);
        }

        return response()->json($response);
    }

    public function info(Request $request, ComplaintServices $complaintServices): \Illuminate\Http\JsonResponse
    {
        $complaintData = $complaintServices->getSingleGrievanceInfo($request);

        if (isSuccessResponse($complaintData)) {
            $response = responseFormat('success', $complaintData['data']);
        } else {
            $response = responseFormat('error', $complaintData['data']);
        }

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComplaintServices $complaintServices): \Illuminate\Http\JsonResponse
    {
        $complaintDetailsData = $complaintServices->updateFeedback($request);

        if (isSuccessResponse($complaintDetailsData)) {
            $response = responseFormat('success', $complaintDetailsData['data']);
        } else {
            $response = responseFormat('error', $complaintDetailsData['data']);
        }

        return response()->json($response);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Complaint $complaint)
    {
        //
    }
}
