<?php

namespace App\Http\Controllers;

use App\Models\Occupation;
use Illuminate\Http\Request;
use App\Services\OccupationServices;

class OccupationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, OccupationServices $occupationServices): \Illuminate\Http\JsonResponse
    {
        $occupationData = $occupationServices->getOccupationInfo($request);

        if (isSuccessResponse($occupationData)) {
            $response = responseFormat('success', $occupationData['data']);
        } else {
            $response = responseFormat('error', $occupationData['data']);
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
     * @param  \App\Models\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function show(Occupation $occupation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function edit(Occupation $occupation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Occupation $occupation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Occupation $occupation)
    {
        //
    }
}
