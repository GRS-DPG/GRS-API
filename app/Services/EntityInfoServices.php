<?php

namespace App\Services;

use App\Models\BatchInfo;
use App\Models\CourseInfo;
use App\Models\EntityAssessor;
use App\Models\EntityInfo;
use App\Models\EntityTrainer;
use App\Models\EntityTrainingTarget;
use App\Models\TraineeEmployment;
use App\Models\TraineeInfo;
use App\Models\TrainingAssessment;
use App\Models\TrainingPaymentCertification;
use App\Models\TrainingPaymentEmployment;
use App\Models\TrainingPaymentEnrollment;
use App\Models\User;
use App\Models\Employee;
use App\Models\EntityOrganogram;
use App\Models\EntityTrancheContract;
use App\Models\TrainingInstituteInfo;
use App\Models\EntityTranche;
use App\Models\UpdateLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class EntityInfoServices
{
    public function getAllEntity(Request $request): array
    {
        try {
            $tranche_id = isset($request->tranche_id) ? explode(',', $request->tranche_id) : [];;
            $entity_type_id = $request->entity_type;
            $entity_id = $request->entity_id;

            $query = EntityInfo::query();
            $query->when($entity_type_id, function ($q, $entity_type_id) {
                return $q->where('entity_type_id', $entity_type_id);
            });
            $query->when($entity_id, function ($q, $entity_id) {
                return $q->where('id', $entity_id);
            });
            $query->when($tranche_id, function ($q, $tranche_id) {

                return $q->whereHas('entity_tranche', function ($q) use ($tranche_id) {
                    $q->whereIn('tranche_id', $tranche_id);
                });
            });
            if ($request->all) {
                $allEntity = $query->with('tranches', 'attach_file_info', 'entity_type_info', 'industry_sector_info', 'division_info', 'district_info', 'sub_district_info')->where('active_status', 1)->orderBy('entity_short_name')->get();
            } else {
                $allEntity = $query->with('tranches', 'attach_file_info', 'entity_type_info', 'industry_sector_info', 'division_info', 'district_info', 'sub_district_info')->where('active_status', 1)->where('entity_type_id', '>', 1004)->orderBy('entity_short_name')->get();
            }



            $data = ['status' => 'success', 'data' => $allEntity];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }
    public function AllEntityName(Request $request): array
    {
        try {
            $tranche_id = isset($request->tranche_id) ? explode(',', $request->tranche_id) : [];

            $entity_id = isset($request->entity) ? explode(',', $request->entity) : [];

            $query = EntityInfo::query();

            $query->when($entity_id, function ($q, $entity_id) {
                return $q->whereIn('id', $entity_id);
            });

            if ($request->all) {
                $allEntity = $query->select('entity_short_name', 'entity_name')->where('active_status', 1)->orderBy('entity_short_name')->get();
            } else {
                $allEntity = $query->select('entity_short_name', 'entity_name')->where('active_status', 1)->where('entity_type_id', '>', 1004)->orderBy('entity_short_name')->get();
            }



            $data = ['status' => 'success', 'data' => $allEntity];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }


    public function getTotalCount($id)
    {
        try {
            $tranche = [
                'Tranche-1' => 1,
                'Tranche-2' => 2,
                'Additional-Tranche-1' => 3,
                'Additional-Tranche-2' => 4,
                'Tranche-3' => 5,
            ];
            $data = [];
            $massData = [];
            foreach ($tranche as $key => $value) {
                $courseInfo = CourseInfo::where('entity_id', $id)->where('tranche', $value)->where('active_status', 1);
                $courseCount = $courseInfo->count();
                $total_target_batch = $courseInfo->sum('total_target_batches');
                $Institute = TrainingInstituteInfo::whereHas('entities', function ($query) use ($id) {
                    return $query->where('entity_id', $id);
                })->where('active_status', 1)->count();
                $total_trainee_target = EntityTrainingTarget::where('entity_info_id', $id)->where('tranche_id', $value)->where('active_status', 1)->sum('target_trainee_number');
                $batchInfo = BatchInfo::where('tranche_id', $value)->where('entity_id', $id);
                $total_batches = $batchInfo->count();
                $today = Carbon::today();
                $running_batches = $batchInfo->where('start_date', '<=', $today)->where('end_date', '>=', $today)->count();
                $trainerInfo = EntityTrainer::where('active_status', 1)->whereHas('map_entity_institute_course_trainer', function ($query) use ($id, $value) {
                    return $query->where('entity_info_id', $id)->where('x_tranche_id', $value)->distinct('entity_trainer_id');
                });
                $total_trainer = $trainerInfo->count();
                $assessorInfo = EntityAssessor::where('active_status', 1)->whereHas('map_entity_institute_course_assessor', function ($query) use ($id, $value) {
                    return $query->where('entity_info_id', $id)->where('x_tranche_id', $value)->distinct('entity_assessor_id');
                });
                $total_assessor = $assessorInfo->count();
                $traineeInfo = TraineeInfo::where('entity_id', $id)->where('tranche_id', $value)->where('enrollment_status', 1);
                $enrolled_trainees = $traineeInfo->count();
                $enrolledFemaleTrainees = $traineeInfo->where('gender', 'female')->count();
                $trainingAssessment = TrainingAssessment::where('entity_id', $id)->where('x_tranche_id', $value);
                $assessedTrainees = $trainingAssessment->count();
                $femaleAssessedTrainees = $trainingAssessment->whereHas('trainee_info', function ($query) use ($id) {
                    return $query->where('gender', 'female');
                })->count();

                $certifiedTrainee = TrainingAssessment::where('entity_id', $id)->where('x_tranche_id', $value)->where('is_certification', 1);
                $certifiedTrainees = $certifiedTrainee->count();
                $femaleCertifiedTrainee = $certifiedTrainee->whereHas('trainee_info', function ($query) use ($id) {
                    return $query->where('gender', 'female');
                })->count();

                $employedTrainee = TraineeEmployment::where('entity_info_id', $id)->where('tranche_id', $value)->distinct('trainee_profile_id');
                $employedTrainees = $employedTrainee->count();
                $femaleEmployedTrainees = $employedTrainee->whereHas('trainee_info', function ($query) {
                    return $query->where('gender', 'female');
                })->count();

                $claim1Bill = TrainingPaymentEnrollment::where('tranche', $value)->where('entity_id', $id)->where('active_status', 3)->sum('net_payable');
                $claim2Bill = TrainingPaymentCertification::where('tranche', $value)->where('entity_id', $id)->where('active_status', 3)->sum('net_payable');
                $claim3Bill = TrainingPaymentEmployment::where('tranche', $value)->where('entity_id', $id)->where('active_status', 3)->sum('net_payable');
                $totalBill = $claim1Bill + $claim2Bill + $claim3Bill;
                $data[$key]['courses'] = $courseCount;
                $data[$key]['institute'] = $Institute;
                $data[$key]['total_target_trainee'] = $total_trainee_target;
                $data[$key]['total_batches'] = $total_batches;
                $data[$key]['total_target_batches'] = $total_target_batch;
                $data[$key]['total_trainer'] = $total_trainer;
                $data[$key]['total_assessor'] = $total_assessor;
                $data[$key]['running_batches'] = $running_batches;
                $data[$key]['enrolled_trainees'] = $enrolled_trainees;
                $data[$key]['assessed_trainees'] = $assessedTrainees;
                $data[$key]['certified_trainees'] = $certifiedTrainees;
                $data[$key]['employed_trainees'] = $employedTrainees;
                $data[$key]['female_enrolled_trainees'] = $enrolledFemaleTrainees;
                $data[$key]['female_assessed_trainees'] = $femaleAssessedTrainees;
                $data[$key]['female_certified_trainees'] = $femaleCertifiedTrainee;
                $data[$key]['female_employed_trainees'] = $femaleEmployedTrainees;
                $data[$key]['claim1bill'] = $claim1Bill;
                $data[$key]['claim2bill'] = $claim2Bill;
                $data[$key]['claim3bill'] = $claim3Bill;
                $data[$key]['totalBill'] = $totalBill;
            }


            $resulteddata = ['status' => 'success', 'data' => $data];
        } catch (\Exception $exception) {
            $resulteddata = ['status' => 'error', 'data' => $exception->getMessage()];
        }

        return $resulteddata;
    }
    public function getAllPendingEntity(Request $request): array
    {

        try {
            $entity_id = $request->entity_id;
            $query = EntityInfo::query();

            $query->when($entity_id, function ($q, $entity_id) {
                return $q->where('id', $entity_id);
            });


            $allEntity = $query->with('tranches')->where('update_status', 1)->get();



            $data = ['status' => 'success', 'data' => $allEntity];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }

    public function save(Request $request)
    {

        $data = [];
        try {
            //Entity info insert

            $data['entity_type_id'] = $request->entity_type_id;
            $data['entity_name'] = $request->entity_name;
            $data['entity_short_name'] = $request->entity_short_name;
            $data['entity_description'] = $request->entity_description;
            $data['registration_number'] = $request->entity_registration_number;
            $data['registration_date'] = $request->entity_registration_date;
            $data['registration_authority'] = $request->entity_registration_authority;
            $data['address'] = $request->entity_address;
            $data['postcode'] = $request->entity_postcode;
            $data['sub_district'] = $request->entity_sub_district;
            $data['district'] = $request->entity_district;
            $data['division'] = $request->entity_division;
            $data['industry_sector'] = $request->entity_industry_sector;
            $data['telephone'] = $request->entity_telephone;
            $data['fax'] = $request->entity_fax;
            $data['email'] = $request->entity_email;
            $data['web_url'] = $request->entity_web_url;
            if ($request->is_bill_author) {
                $data['is_bill_author'] = $request->is_bill_author;
            }
            $data['status_remarks'] = $request->status_remarks;
            $data['active_status'] = 1;
            $data['update_status'] = 0;
            $data['created_by'] = $request->user_id;
            $data['updated_by'] = $request->user_id;

            $entity_info = EntityInfo::create($data);

            return $entity_info;
        } catch (\Exception $exception) {

            return $exception->getMessage();
        }
    }
    public function update(Request $request)
    {

        try {

            $data = [];
            $entity_info = EntityInfo::find($request->id);
            $entity_info->entity_type_id = $request->entity_type_id;
            $entity_info->entity_name = $request->entity_name;
            $entity_info->entity_short_name = $request->entity_short_name;
            $entity_info->entity_description = $request->entity_description;
            $entity_info->registration_number = $request->registration_number;
            $entity_info->registration_date = $request->registration_date;
            $entity_info->registration_authority = $request->registration_authority;
            $entity_info->address = $request->address;
            $entity_info->postcode = $request->postcode;
            $entity_info->district = $request->district;
            $entity_info->sub_district = $request->sub_district;
            $entity_info->division = $request->division;
            $entity_info->industry_sector = $request->industry_sector;
            $entity_info->telephone = $request->telephone;
            $entity_info->fax = $request->fax;
            $entity_info->email = $request->email;
            $entity_info->web_url = $request->web_url;
            $entity_info->is_bill_author = $request->is_bill_author;


            $changes = array();
            foreach ($entity_info->getDirty() as $key => $value) {
                $original = $entity_info->getOriginal($key);
                $changes[$key] = $value;
            }

            $data['model_name'] = "EntityInfo";
            $data['table_row_id'] = $request->id;
            $data['content_change'] = json_encode($changes);
            $data['form_data'] = json_encode($entity_info);
            $data['active_status'] = 0;
            $data['updated_by'] = $request->user_id;


            UpdateLog::create($data);

            EntityInfo::where('id', $request->id)->update(['update_status' => 1]);


            return $entity_info;
        } catch (\Exception $exception) {

            return $exception->getMessage();
        }
    }


    public function organogramSave($entity_id, $employee_id, $designation, $user_id = null)
    {
        try {

            //Entity orgranogram data insert
            $data = [];

            $data['entity_id'] = $entity_id;
            $data['employee_id'] = $employee_id;
            $data['entity_type_role_id'] = $designation;
            $data['assign_date'] = date('Y-m-d');
            $data['active_status'] = 1;
            $data['created_by'] = $user_id;
            $data['updated_by'] = $user_id;

            $organogram_info = EntityOrganogram::create($data);

            return $organogram_info;
        } catch (\Exception $exception) {

            return $exception->getMessage();
        }
    }

    public function getEntityInfo($id)
    {
        try {

            $entityInfo = EntityInfo::where('id', $id)->with('attach_file_info', 'entity_type_info', 'industry_sector_info', 'division_info', 'district_info', 'sub_district_info')->first();

            $data = ['status' => 'success', 'data' => $entityInfo];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }
    public function updateEntityStatus(Request $request, $id)
    {
        try {

            $data['active_status'] = $request['active_status'];
            $data['update_status'] = 0;

            EntityInfo::where('id', $id)->update($data);
            UpdateLog::where('table_row_id', $id)->where('model_name', 'EntityInfo')->update(['active_status' => 2]);

            $data = ['status' => 'success', 'data' => 'Entity Rejected Successfully'];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }
    public function getUpdateLog($model, $id)
    {

        try {

            $updateLogInfo = UpdateLog::where('model_name', $model)->where('table_row_id', $id)->where('active_status', 0)->orderBy('id', 'desc')->first();
            // return  $updateLogInfo;
            $data = ['status' => 'success', 'data' => $updateLogInfo];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }
    public function approveEntity(Request $request, $update_info, $id)
    {
        try {
            $data = array();
            if ($update_info) {
                foreach ($update_info as $key => $vl) {
                    $data[$key] = $vl;
                }
            }
            $data['active_status'] = 1;
            $data['update_status'] = 0;

            EntityInfo::where('id', $id)->update($data);
            UpdateLog::where('table_row_id', $id)->where('model_name', 'EntityInfo')->update(['active_status' => 1]);

            $data = ['status' => 'success', 'data' => 'Entity Approved Successfully'];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }

    public function deleteEntity($id)
    {


        DB::beginTransaction();
        try {
            $contract_check = EntityTrancheContract::where('entity_info_id', $id);

            $contract_count = $contract_check->count();

            if ($contract_count > 0) {
                $data = ['status' => 'error', 'data' => 'Entity can not be deleted'];
            } else {
                EntityInfo::where('id', $id)->delete();

                $employee_ids = EntityOrganogram::where('entity_id', $id)->pluck('employee_id');
                $user_ids = Employee::whereIn('id', $employee_ids)->pluck('user_id');

                EntityOrganogram::whereIn('employee_id', $employee_ids)->delete();
                Employee::whereIn('id', $employee_ids)->delete();
                User::whereIn('id', $user_ids)->delete();

                DB::commit();
                $data = ['status' => 'success', 'data' => 'Entity Deleted Successfully'];
            }
        } catch (\Exception $exception) {
            //DB::rollBack();
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }
    public function getAllEntityName(Request $request): array
    {

        try {
            $tranche_id = $request->tranche_id;
            $course_info_id = $request->course_info_id;
            $district = $request->district;

            $query = EntityInfo::query();

            $query->when($district, function ($q, $district) {
                return $q->where('district', $district);
            });
            $query->when($tranche_id, function ($q, $tranche_id) {

                return $q->whereHas('entity_tranche', function ($q) use ($tranche_id) {
                    $q->where('tranche_id', $tranche_id);
                });
            });
            $query->when($course_info_id, function ($q, $course_info_id) {

                return $q->whereHas('courses', function ($q) use ($course_info_id) {
                    $q->where('id', $course_info_id);
                });
            });

            $allEntity = $query->select('id', 'entity_name', 'entity_short_name')->where('active_status', 1)->get();

            $data = ['status' => 'success', 'data' => $allEntity];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }
}
