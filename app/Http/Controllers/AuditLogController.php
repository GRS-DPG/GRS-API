<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Services\AuditLogServices;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,AuditLogServices $auditLogServices)
    {
        $view=$auditLogServices->searchLog($request);
        if(isSuccessResponse($view)){
            $response=responseFormat('success',$view['data']);
        }else{
            $response=responseFormat('error',$view['data']);
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
     * @param  \App\Models\AuditLog  $auditLog
     * @return \Illuminate\Http\Response
     */
    public function show(AuditLog $auditLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AuditLog  $auditLog
     * @return \Illuminate\Http\Response
     */
    public function edit(AuditLog $auditLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AuditLog  $auditLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AuditLog $auditLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AuditLog  $auditLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(AuditLog $auditLog)
    {
        //
    }
}
