<?php

namespace App\Services;

use App\Models\Complainant;
use App\Models\Complaint;
use App\Models\ComplaintMovement;
use App\Models\OfficesGro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ComplaintServices
{
    public function getComplaintInfo(Request $request): array
    {
        try {
            //$tranche_id = isset($request->tranche_id) ? explode(',', $request->tranche_id) : [];;
            $complainant_id = $request->complainant_id;
            $to_employee_record_id = $request->to_employee_record_id;
            $from_employee_record_id = $request->from_employee_record_id;

            $query = Complaint::query();
            $query->when($complainant_id, function ($q, $complainant_id) {
                return $q->where('complainant_id', $complainant_id);
            });
            $query->when($to_employee_record_id, function ($q, $to_employee_record_id) {

                return $q->whereHas('complaint_movement_info', function ($q) use ($to_employee_record_id) {
                    $q->where('to_employee_record_id', $to_employee_record_id);
                });
            });
            $query->when($from_employee_record_id, function ($q, $from_employee_record_id) {

                return $q->whereHas('complaint_movement_info', function ($q) use ($from_employee_record_id) {
                    $q->where('from_employee_record_id', $from_employee_record_id);
                });
            });

            $allComplaint = $query->get();

            $data = ['status' => 'success', 'data' => $allComplaint];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;

    }

    public function getComplaintDetails(Request $request): array
    {
        try {
            //$tranche_id = isset($request->tranche_id) ? explode(',', $request->tranche_id) : [];;
            $complaint_id = $request->complaint_id;
            $tracking_number = $request->tracking_number;

            $query = Complaint::query();
            $query->when($complaint_id, function ($q, $complaint_id) {
                return $q->where('id', $complaint_id);
            });
            $query->when($tracking_number, function ($q, $tracking_number) {
                return $q->where('tracking_number', $tracking_number);
            });

            $allComplaintDetails = $query->with('complaint_attachment_info')->first();
           

            $data = ['status' => 'success', 'data' => $allComplaintDetails];

            $doptorApiServices = new DoptorApiServices();
            $complainHistory = $this->getComplaintHistory($request);


            $office_id = $allComplaintDetails->office_id;
            $prams = 'id='.$office_id;
          
            $doptorOffice = $doptorApiServices->getDoptorOfficeInfo($prams);
        
            $isGRSUser = $allComplaintDetails->is_grs_user;
            $complainant_id = $allComplaintDetails->complainant_id;
            $employeeprams = 'employeeRecord='.$complainant_id;
            $doptorData = $doptorApiServices->getDoptorData('empoffice',$employeeprams);

            if($isGRSUser==1){
                    $complainant_info = Complainant::where('id', $complainant_id)->first();
                    $result['complainant_info'] = $complainant_info;
                   
            }else{
                $complainant_info = $doptorData['data'];
                $result['admin_officer_info'] = $complainant_info;

            }

           $result['allComplaintDetails'] = $allComplaintDetails;
           $result['doptoroffice'] = $doptorOffice['data'][0];
           $result['complainHistory'] = $complainHistory['data'];


            $data = ['status' => 'success', 'data' => $result];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }
      public function getComplaintMovementInfo(Request $request): array
    {
        try {
            $complaint_id = $request->complaint_id;

            $query = ComplaintMovement::query();
            $query->when($complaint_id, function ($q, $complaint_id) {
                return $q->where('complaint_id', $complaint_id);
            });


            $allMovementInfo = $query->with('complain_movement_attachment')->get();


            $data = ['status' => 'success', 'data' => $allMovementInfo];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }

      public function getGrievanceTrack(Request $request): array
    {
        try {
            //$tranche_id = isset($request->tranche_id) ? explode(',', $request->tranche_id) : [];;
            $tracking_number = $request->tracking_number;

            $query = Complaint::query();

            $query->when($tracking_number, function ($q, $tracking_number) {
                return $q->where('tracking_number', $tracking_number);
            });

            $allComplaintDetails = $query->first();

            $data = ['status' => 'success', 'data' => $allComplaintDetails];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }
      public function getComplaintHistory(Request $request): array
    {
        try {
            //$tranche_id = isset($request->tranche_id) ? explode(',', $request->tranche_id) : [];;
            $complaint_id = $request->complaint_id;

            $query = ComplaintMovement::query();
            $query->when($complaint_id, function ($q, $complaint_id) {
                return $q->where('complaint_id', $complaint_id);
            });

            $allComplaintHistory = $query->orderBy('created_at','DESC')->get();

            $data = ['status' => 'success', 'data' => $allComplaintHistory];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }
    public function updateFeedback(Request $request): array
    {
        try {
            $complaint_id = $request->complaint_id;

            $data = [];
            $data['rating'] = $request->rating;
            $data['feedback_comments'] =  $request->feedback_comments;

          $allComplaintDetails = Complaint::where('id', $complaint_id)->update($data);

            $data = ['status' => 'success', 'data' => $allComplaintDetails];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }

    public function save(Request $request): array
    {

        $data = [];
        if($request->is_grs_user == 1){
            $complaintInfo = Complaint::where('complainant_id',$request->complainant_id)->orderBy('id','desc')->first();
            if($complaintInfo){
                $pre_tracking_number = substr($complaintInfo->tracking_number, 1);
                $new_tracking_number = '0'.($pre_tracking_number+1);
            }else{
                $complainantInfo = Complainant::where('id',$request->complainant_id)->first();
                $new_tracking_number = $complainantInfo->mobile_number.'100';
            }
        }else{
            $complaintInfo = Complaint::where('is_grs_user',0)->orderBy('id','desc')->first();
            $new_tracking_number = $complaintInfo->tracking_number + 1;
        }

        // if($complaintInfo){
        //     $pre_tracking_number = substr($complaintInfo->tracking_number, 1);
        //     $new_tracking_number = '0'.($pre_tracking_number+1);
        // }else{
        //     $complaintInfo = Complainant::where('id',$request->complainant_id)->first();
        //     $new_tracking_number = $complaintInfo->mobile_number.'100';
        // }

        $banglaConverterServices = new BanglaConverterServices();
        $submission_date_bn = $banglaConverterServices->convertDateTimeBangla(date("Y-m-d h:i:sa"));
        $tracking_number_bn = $banglaConverterServices->convertNumberBangla($new_tracking_number);

        $officesGro = OfficesGro::where('office_id',$request->officeId)->first();

        $status = 0;

        if($officesGro){
            $status = 1;
        }

        try {

            $data['subject'] = $request->subject;
            $data['submission_date'] = date("Y-m-d h:i:sa");
            $data['submission_date_bn'] = $submission_date_bn;
            $data['complaint_type'] = 'Nagorik';
            $data['complaint_type_bn'] = 'নাগরিক';
            $data['current_status'] = 'New';
            $data['current_status_bn'] = 'নতুন';
            $data['details'] = $request->description;
            $data['tracking_number'] = $new_tracking_number;
            $data['tracking_number_bn'] = $tracking_number_bn;
            $data['complainant_id'] = $request->complainant_id;
            $data['is_grs_user'] = $request->is_grs_user;
            $data['office_id'] = $request->officeId;
            $data['is_self_motivated_grievance'] = 1;
            $data['other_service'] = 'অন্যান্য';
            $data['source_of_grievance'] = 'COMPLAINANT';
            $data['status'] = $status;

            $complaint = Complaint::create($data);

            if($officesGro){

                $prams = 'organogram='.$officesGro->gro_office_unit_organogram_id;

                $doptorApiServices = new DoptorApiServices();

                $employeeInfo =  $doptorApiServices->getDoptorData('empoffice', $prams);

                $employeeInfo = $employeeInfo['data'];

                if(is_array($employeeInfo)){

                    $note = '<p>অভিযোগকারী একটি নতুন অভিযোগ জমা দিয়েছেন</p>';

                    $movementData = [];

                    $movementData['complaint_id'] = $complaint->id;
                    $movementData['note'] = $note;
                    $movementData['action'] = 'NEW';
                    $movementData['to_employee_record_id'] = $employeeInfo[0]['employeeRecord'];
                    $movementData['from_employee_record_id'] = $employeeInfo[0]['employeeRecord'];
                    $movementData['to_office_unit_organogram_id'] = $officesGro->gro_office_unit_organogram_id;
                    $movementData['from_office_unit_organogram_id'] = $officesGro->gro_office_unit_organogram_id;
                    $movementData['to_office_id'] = $request->officeId;
                    $movementData['from_office_id'] = $request->officeId;
                    $movementData['to_office_unit_id'] = $employeeInfo[0]['unit'];
                    $movementData['from_office_unit_id'] = $employeeInfo[0]['unit'];
                    $movementData['to_employee_name_bng'] = $employeeInfo[0]['name_bng'];
                    $movementData['from_employee_name_bng'] = $employeeInfo[0]['name_bng'];
                    $movementData['to_employee_designation_bng'] =  $employeeInfo[0]['designation'];
                    $movementData['from_employee_designation_bng'] =  $employeeInfo[0]['designation'];
                    $movementData['to_office_name_bng'] = $officesGro->office_name_bng;
                    $movementData['from_office_name_bng'] = $officesGro->office_name_bng;
                    $movementData['to_employee_unit_name_bng'] = $officesGro->gro_office_unit_name;
                    $movementData['from_employee_unit_name_bng'] = $officesGro->gro_office_unit_name;
                    $movementData['is_current'] = 0;
                    $movementData['is_cc'] = 0;
                    $movementData['is_committee_head'] = 0;
                    $movementData['is_committee_member'] = 0;
                    $movementData['current_status'] = 'NEW';
                    $movementData['assigned_role'] = 'GRO';

                    $complaintMovement = ComplaintMovement::create($movementData);
                }
            }


            $data = ['status' => 'success', 'data' => 'Saved Successfully.'];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }

    public function savePublicGrievance(Request $request): array
    {

        $data = [];
        $complainant_id = 0;
        if($request->complainant_id){
            $complainant_id = $request->complainant_id;
            if($request->is_grs_user == 1){
                $complaintInfo = Complaint::where('complainant_id',$request->complainant_id)->orderBy('id','desc')->first();
                if($complaintInfo){
                    $pre_tracking_number = substr($complaintInfo->tracking_number, 1);
                    $new_tracking_number = '0'.($pre_tracking_number+1);
                }else{
                    $complainantInfo = Complainant::where('id',$request->complainant_id)->first();
                    $new_tracking_number = $complainantInfo->mobile_number.'100';
                }
            }else{
                $complaintInfo = Complaint::where('is_grs_user',0)->orderBy('id','desc')->first();
                $new_tracking_number = $complaintInfo->tracking_number + 1;
            }

        }elseif($request->mobile_number){

            $complainantInfo = Complainant::where('mobile_number',$request->mobile_number)->first();

            if($complainantInfo){
                $complainant_id = $complainantInfo->id;
                $complaintInfo = Complaint::where('complainant_id',$complainantInfo->id)->orderBy('id','desc')->first();

                if($complaintInfo){
                    $pre_tracking_number = substr($complaintInfo->tracking_number, 1);
                    $new_tracking_number = '0'.($pre_tracking_number+1);
                }else{
                    $new_tracking_number = $complainantInfo->mobile_number.'100';
                }
            }else{
                $complainantData = [];

                $complainantData['name'] = $request->name;
                $complainantData['mobile_number'] = $request->mobile_number;
                $complainantData['email'] = $request->email;
                $complainantData['nationality_id'] = 15;
                $complainantData['permanent_address_country_id'] = 15;

                $newComplainant = Complainant::create($complainantData);

                $new_tracking_number = $request->mobile_number.'100';
                $complainant_id = $newComplainant->id;
            }
        }else{
            $complaintInfo = Complaint::where('complainant_id', 0)->orderBy('id','desc')->first();
            $new_tracking_number = $complaintInfo->tracking_number + 1;
        }

        $banglaConverterServices = new BanglaConverterServices();
        $submission_date_bn = $banglaConverterServices->convertDateTimeBangla(date("Y-m-d h:i:sa"));
        $tracking_number_bn = $banglaConverterServices->convertNumberBangla($new_tracking_number);

        try {

            $officesGro = OfficesGro::where('office_id',$request->officeId)->first();

            $status = 0;

            if($officesGro){
                $status = 1;
            }

            $data['subject'] = $request->subject;
            $data['submission_date'] = date("Y-m-d h:i:sa");
            $data['submission_date_bn'] = $submission_date_bn;
            $data['complaint_type'] = 'Nagorik';
            $data['complaint_type_bn'] = 'নাগরিক';
            $data['current_status'] = 'New';
            $data['current_status_bn'] = 'নতুন';
            $data['details'] = $request->description;
            $data['tracking_number'] = $new_tracking_number;
            $data['tracking_number_bn'] = $tracking_number_bn;
            $data['complainant_id'] = $complainant_id;
            $data['is_grs_user'] = 1;
            $data['office_id'] = $request->officeId;
            $data['is_grs_user'] = $request->is_grs_user;
            $data['is_self_motivated_grievance'] = 1;
            $data['other_service'] = 'অন্যান্য';
            $data['source_of_grievance'] = 'COMPLAINANT';
            $data['status'] = $status;

            $complaint = Complaint::create($data);

            if($officesGro){

                $prams = 'organogram='.$officesGro->gro_office_unit_organogram_id;

                $doptorApiServices = new DoptorApiServices();

                $employeeInfo =  $doptorApiServices->getDoptorData('empoffice', $prams);

                $employeeInfo = $employeeInfo['data'];

                $note = '<p>অভিযোগকারী একটি নতুন অভিযোগ জমা দিয়েছেন</p>';

                $movementData = [];

                $movementData['complaint_id'] = $complaint->id;
                $movementData['note'] = $note;
                $movementData['action'] = 'NEW';
                $movementData['to_employee_record_id'] = $employeeInfo[0]['employeeRecord'];
                $movementData['from_employee_record_id'] = $employeeInfo[0]['employeeRecord'];
                $movementData['to_office_unit_organogram_id'] = $officesGro->gro_office_unit_organogram_id;
                $movementData['from_office_unit_organogram_id'] = $officesGro->gro_office_unit_organogram_id;
                $movementData['to_office_id'] = $request->officeId;
                $movementData['from_office_id'] = $request->officeId;
                $movementData['to_office_unit_id'] = $employeeInfo[0]['unit'];
                $movementData['from_office_unit_id'] = $employeeInfo[0]['unit'];
                $movementData['to_employee_name_bng'] = $employeeInfo[0]['name_bng'];
                $movementData['from_employee_name_bng'] = $employeeInfo[0]['name_bng'];
                $movementData['to_employee_designation_bng'] =  $employeeInfo[0]['designation'];
                $movementData['from_employee_designation_bng'] =  $employeeInfo[0]['designation'];
                $movementData['to_office_name_bng'] = $officesGro->office_name_bng;
                $movementData['from_office_name_bng'] = $officesGro->office_name_bng;
                $movementData['to_employee_unit_name_bng'] = $officesGro->gro_office_unit_name;
                $movementData['from_employee_unit_name_bng'] = $officesGro->gro_office_unit_name;
                $movementData['is_current'] = 0;
                $movementData['is_cc'] = 0;
                $movementData['is_committee_head'] = 0;
                $movementData['is_committee_member'] = 0;
                $movementData['current_status'] = 'NEW';
                $movementData['assigned_role'] = 'GRO';

                $complaintMovement = ComplaintMovement::create($movementData);
            }

            $data = ['status' => 'success', 'data' => 'Saved Successfully.'];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }

    public function getSingleGrievanceInfo(Request $request): array
    {
        try {

            $complaint_id = $request->complaint_id;

            $query = Complaint::query();
            $query->when($complaint_id, function ($q, $complaint_id) {
                return $q->where('id', $complaint_id);
            });

            $complaintInfo = $query->first();

            $data = ['status' => 'success', 'data' => $complaintInfo];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }

}
