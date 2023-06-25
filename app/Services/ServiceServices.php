<?php

namespace App\Services;

use App\Models\OfficesGro;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ServiceServices
{
    public function getServiceInfo(Request $request): array
    {
        try {

            $office_origin_id = $request->office_origin_id;

            if($request->office_id){
                $officeGro = OfficesGro::where('office_id',$request->office_id)->first();
                $office_origin_id = $officeGro->office_origin_id;
            }


            $query = Service::query();

            $query->when($office_origin_id, function ($q, $office_origin_id) {
                return $q->where('office_origin_id', $office_origin_id);
            });

            $allService = $query->where('status',1)->get();

            $data = ['status' => 'success', 'data' => $allService];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }





}
