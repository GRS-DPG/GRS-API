<?php

namespace App\Services;

use App\Models\Complainant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ComplainantServices
{
    public function getComplainantData(Request $request): array
    {
        try {
            //$tranche_id = isset($request->tranche_id) ? explode(',', $request->tranche_id) : [];;
            $complainant_id = $request->complainant_id;

            $query = Complainant::query();
            $query->when($complainant_id, function ($q, $complainant_id) {
                return $q->where('complainant_id', $complainant_id);
            });

            $allComplaint = $query->get();

            $data = ['status' => 'success', 'data' => $allComplaint];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }


    public function save(Request $request): array
    {

        $data = [];

        $complaintInfo = Complainant::where('mobile_number',$request->mobile_number)->first();

        if($complaintInfo){
            return ['status' => 'error', 'data' => 'Mobile number already exist'];
        }
        try {
            //$random_password = random_int(100000, 999999);
            $random_password = '123456';

            $data['name'] = $request->name;
            $data['identification_value'] = $request->identification_value;
            $data['identification_type'] = $request->identification_type;
            $data['mobile_number'] = $request->mobile_number;
            $data['email'] = $request->email;
            $data['birth_date'] = $request->birth_date;
            $data['occupation'] = $request->occupation;
            $data['educational_qualification'] = $request->educational_qualification;
            $data['gender'] = $request->gender;
            $data['username'] = $request->mobile_number;
            $data['password'] = Hash::make($random_password);;
            $data['nationality_id'] = $request->nationality_id;
            $data['permanent_address_street'] = $request->permanent_address_street;
            $data['permanent_address_house'] = $request->permanent_address_house;
            $data['is_authenticated'] = 1;
            $data['permanent_address_country_id'] = $request->permanent_address_country_id;

            $Complainant = Complainant::create($data);

            $data = ['status' => 'success', 'data' => 'Saved Successfully'];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }
    public function getComplainantInfo(Request $request): array
    {
        try {
            //$tranche_id = isset($request->tranche_id) ? explode(',', $request->tranche_id) : [];;
            $mobile_number = $request->mobile_number;

            $query = Complainant::query();
            $query->when($mobile_number, function ($q, $mobile_number) {
                return $q->where('mobile_number', $mobile_number);
            });

            $omplainantInfo = $query->first();

            $data = ['status' => 'success', 'data' => $omplainantInfo];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }

}
