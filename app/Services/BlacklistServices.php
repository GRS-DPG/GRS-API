<?php

namespace App\Services;

use App\Models\Complainant;
use App\Models\Complaint;
use App\Models\Blacklist;
use App\Models\ComplaintMovement;
use App\Models\OfficesGro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class BlacklistServices
{
    public function getBlacklistComplainantInfo(Request $request): array
    {
       
        try {

            $office_id = $request->office_id;
            $query = Blacklist::query();

            $blacklistComplainant = $query->where('office_id',$office_id )->with('complainant_info')->orderBy('created_at','desc')->get();

            $data = ['status' => 'success', 'data' => $blacklistComplainant];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;

    }
    public function getblacklistStatus(Request $request): array
    {
        try {
            $blacklist_id = $request->blacklist_id;

            $result = Blacklist::where('id', $blacklist_id)->update(['blacklisted' => $request->blacklisted]);


            $data = ['status' => 'success', 'data' => $result];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;

    }

}
