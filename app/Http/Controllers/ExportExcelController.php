<?php

namespace App\Http\Controllers;

use App\Exports\StipendListExport;
use App\Imports\ExcelImport;
use App\Services\StipendServices;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportExcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportTrainee(StipendServices $stipendServices, Request $request)
    {
        $trainee = $stipendServices->selectedTraineeListForExcel($request);
        //        $trainee=[[1, 2, 3],
        //        [4, 5, 6]];

        $export = new StipendListExport($trainee);


        return Excel::download($export, 'demo.xlsx');
    }

    public function importFile(Request $request)
    {
        if ($request->hasFile('file')) {
            $data = Excel::toArray(new ExcelImport(), $request->file);
        }
        return $data[0];
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
