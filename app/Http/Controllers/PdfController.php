<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    // public function dynamic_institute(Request $request): \Illuminate\Http\JsonResponse
    // {
    //     $table_header = json_decode($request->tableHeader);
    //     $table_data = json_decode($request->tabledata);

    //    $users = User::all();


    //     return $pdf->download('invoice.pdf');

    //     // $all_training_institute = $trainingInstituteInfoServices->getAllTrainingInstituteName($request);
    //     // if (isSuccessResponse($all_training_institute)) {
    //     //     $response = responseFormat('success', $all_training_institute['data']);
    //     // } else {
    //     //     $response = responseFormat('error', $all_training_institute['data']);
    //     // }

    //     // return response()->json($table_header);
    // }
}
