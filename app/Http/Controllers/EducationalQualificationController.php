<?php

namespace App\Http\Controllers;

use App\Models\EducationalQualification;
use Illuminate\Http\Request;
use App\Services\EducationalQualificationServices;

class EducationalQualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, EducationalQualificationServices $educationalQualificationServices): \Illuminate\Http\JsonResponse
    {
        $educationalQualificationServices = $educationalQualificationServices->getEducationalQualificationInfo($request);

        if (isSuccessResponse($educationalQualificationServices)) {
            $response = responseFormat('success', $educationalQualificationServices['data']);
        } else {
            $response = responseFormat('error', $educationalQualificationServices['data']);
        }

        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\EducationalQualification  $educationalQualification
     * @return \Illuminate\Http\Response
     */
    public function show(EducationalQualification $educationalQualification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EducationalQualification  $educationalQualification
     * @return \Illuminate\Http\Response
     */
    public function edit(EducationalQualification $educationalQualification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EducationalQualification  $educationalQualification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EducationalQualification $educationalQualification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EducationalQualification  $educationalQualification
     * @return \Illuminate\Http\Response
     */
    public function destroy(EducationalQualification $educationalQualification)
    {
        //
    }
}
