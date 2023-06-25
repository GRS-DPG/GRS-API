<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DoptorApiServices;

class DoptorApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function officeLayer(Request $request, DoptorApiServices $doptorApiServices): \Illuminate\Http\JsonResponse
    {
        $officeLayerData = $doptorApiServices->getOfficeLayer($request);

        if (isSuccessResponse($officeLayerData)) {
            $response = responseFormat('success', $officeLayerData['data']);
        } else {
            $response = responseFormat('error', $officeLayerData['data']);
        }

        return response()->json($response);
    }

    public function api(Request $request, DoptorApiServices $doptorApiServices): \Illuminate\Http\JsonResponse
    {
        $officeLayerData = $doptorApiServices->getApiData($request);

        if (isSuccessResponse($officeLayerData)) {
            $response = responseFormat('success', $officeLayerData['data']);
        } else {
            $response = responseFormat('error', $officeLayerData['data']);
        }

        return response()->json($response);
    }

    public function office(Request $request, DoptorApiServices $doptorApiServices): \Illuminate\Http\JsonResponse
    {
        $officeLayerData = $doptorApiServices->getDoptorOffice($request);

        if (isSuccessResponse($officeLayerData)) {
            $response = responseFormat('success', $officeLayerData['data']);
        } else {
            $response = responseFormat('error', $officeLayerData['data']);
        }

        return response()->json($response);
    }

    public function doptorData(Request $request, DoptorApiServices $doptorApiServices): \Illuminate\Http\JsonResponse
    {
        $url = $request->api_url;
        $prams = $request->prams;
        $officeLayerData = $doptorApiServices->getDoptorData($url, $prams);

        if (isSuccessResponse($officeLayerData)) {
            $response = responseFormat('success', $officeLayerData['data']);
        } else {
            $response = responseFormat('error', $officeLayerData['data']);
        }

        return response()->json($response);
    }


    public function officeOrganogram(Request $request, DoptorApiServices $doptorApiServices): \Illuminate\Http\JsonResponse
    {

        $officeLayerData = $doptorApiServices->getApiData($request);
        $organogram = [];
        //return response()->json($officeLayerData);
        foreach ($officeLayerData['data'] as $officeId => $officeData) {
            $unitData = [];
            foreach ($officeData['units'] as $unitId => $unit) {
                $designationData = [];
                foreach ($unit['designations'] as $designation) {
                    $name = '';
                    if(!empty($designation['employee_info'])){
                        $name = $designation['employee_info']['name_bng'];
                    }
                    $designationData[] = [
                        'id' => $designation['designation_id'],
                        'label' => $designation['designation_bng'].', '.$name,
                        'designation' => $designation['designation_bng'],
                        'name' => $name
                    ];
                }
                $unitData[] = [
                    'id' => $unit['office_unit_id'],
                    'label' => $unit['unit_name_bng'],
                    'nodes' => $designationData
                ];
            }
            $organogram[] = [
                'id' => $officeData['office_id'],
                'label' =>'শাখাসমূহ',
                'nodes' => $unitData
            ];
        }
        if (isSuccessResponse($officeLayerData)) {
            $response = responseFormat('success', $organogram);
        } else {
            $response = responseFormat('error', $officeLayerData['data']);
        }

        return response()->json($response);
    }
}
