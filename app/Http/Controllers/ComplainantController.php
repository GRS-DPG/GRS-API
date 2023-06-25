<?php

namespace App\Http\Controllers;

use App\Models\Complainant;
use Illuminate\Http\Request;
use App\Services\ComplainantServices;
use App\Http\Requests\Complainant\NewComplainantRequest;
use Illuminate\Support\Facades\Validator;

class ComplainantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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


    public function store(Request $request, ComplainantServices $complainantServices): \Illuminate\Http\JsonResponse
    {
        // Validator::make($request->all(), [
        //     'name' => 'required',
        //     'mobile_number' => 'required|regex:/(01)[0-9]{9}/|unique:complainants,mobile_number',
        //     'identification_value' => 'required',
        //     'entity_registration_date' => 'date|nullable',
        //     'permanent_address_street'=>'required',
        //     'email' => 'email|nullable|unique:complainants,email',
        // ])->validate();
        $complainantData = $complainantServices->save($request);

        if (isSuccessResponse($complainantData)) {
            $response = responseFormat('success', $complainantData['data']);
        } else {
            $response = responseFormat('error', $complainantData['data']);
        }
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ComplainantServices $complainantServices): \Illuminate\Http\JsonResponse
    {
        $complainantData = $complainantServices->getComplainantInfo($request);

        if (isSuccessResponse($complainantData)) {
            $response = responseFormat('success', $complainantData['data']);
        } else {
            $response = responseFormat('error', $complainantData['data']);
        }

        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit(cr $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cr $cr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy(cr $cr)
    {
        //
    }
}
