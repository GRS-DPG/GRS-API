<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use App\Models\XTranche;
use Illuminate\Support\Arr;
use App\Models\TrainingAssessment;
use App\Models\TraineeEmployment;

class AuditLogServices
{

    public function actionCreate($model_name, $table_row_id, $new_data, $user_id)
    {
        try {
          // return $new_data->entity_id;
            $data = [];
            $data['model_name'] = $model_name;
            $data['table_row_id'] = $table_row_id;
            $data['new_data'] = json_encode($new_data);
            $data['entity_id'] = $new_data->entity_id;
            $data['institute_info_id'] = $new_data->institute_info_id;
            $data['tranche'] = $new_data->tranche;
            $data['bill_sequence_no'] =$new_data->bill_sequence_no;   
            $data['responsible_user_id'] = $user_id;
            $data['action_type'] = 1;
            AuditLog::create($data);
            $data = ['status' => 'success', 'data' => 'Audit Log create action success'];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }
    

    public function actionEdit($model_name, $table_row_id, $user_id)
    {
        // return $table_row_id;
        try {
            $entityInfoServices = new EntityInfoServices();
            $update_log = $entityInfoServices->getUpdateLog($model_name, $table_row_id);
            $new_data = $update_log['data']['content_change'];
            $old_data = $this->getOldData($model_name, $table_row_id);
            // return $update_log;
            $data = [];
            $data['model_name'] = $model_name;
            $data['table_row_id'] = $table_row_id;
            $data['new_data'] = $new_data;
            $data['old_data'] = json_encode($old_data['data']);
            $data['responsible_user_id'] = $user_id;
            $data['action_type'] = 2;
            AuditLog::create($data);
            $data = ['status' => 'success', 'data' => 'Audit Log edit action success'];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }

    public function actionEditWithoutApprove($model_name, $table_row_id, $newdata, $user_id)
    {
        $Model = $model_name;
        $NamespacedModel = '\\App\\Models\\' . $model_name;
        $data = $NamespacedModel::find($table_row_id);
       //  $old_data = $this->getOldData($model_name, $table_row_id);
       // $changes = array();
       
        $changes = $newdata;
        $change =  json_decode(json_encode($changes), true);
        $data1 =   json_decode(json_encode($data), true);
        $change= Arr::except($change, ['authorization']);
        // return $change;
        // =   unset($change['authorization']);
        $results = array_diff(array_map('serialize', $change), array_map('serialize', $data1));
         $sol= array_map('unserialize', $results);
       // return $sol;

        try {
            $data = [];
            $old_data = $this->getOldData($model_name, $table_row_id);
            $data['model_name'] = $model_name;
            $data['table_row_id'] = $table_row_id;
            $data['new_data'] = json_encode($sol); 
            //$Arr =  array_diff($data, $changes);
            $data['old_data'] = json_encode($old_data['data']);
            $data['responsible_user_id'] = $user_id;
            //return $user_id;
            $data['action_type'] = 2;
            AuditLog::create($data);
             $data = ['status' => 'success', 'data' => 'Audit Log edit action success'];
        } catch (\Exception $exception) {
             $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
         return $data;
    }

    public function actionApprove($model_name, $new_data, $table_row_id, $user_id)
    {
        try {
            $old_data = $this->getOldData($model_name, $table_row_id);
            $data = [];
            $data['model_name'] = $model_name;
            $data['table_row_id'] = $table_row_id;
            $data['new_data'] = json_encode($new_data);
            $data['old_data'] = json_encode($old_data['data']);
            $data['responsible_user_id'] = $user_id;
            $data['action_type'] = 3;

            $audit = AuditLog::create($data);
            //            return ['status' => 'success', 'data' => $audit];

            $data = ['status' => 'success', 'data' => 'Audit Log approve action success'];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }

    public function actionReject($model_name, $table_row_id, $user_id)
    {
        // return $model_name;
        try {
            $entityInfoServices = new EntityInfoServices();
            $update_log = $entityInfoServices->getUpdateLog($model_name, $table_row_id);
            // return  ['status' => 'success', 'data' => $update_log];

            $new_data = $update_log['data']['content_change'] || "";
            $old_data = $this->getOldData($model_name, $table_row_id);
            $data = [];
            $data['model_name'] = $model_name;
            $data['table_row_id'] = $table_row_id;
            $data['new_data'] = $new_data;
            $data['old_data'] = json_encode($old_data['data']);
            $data['responsible_user_id'] = $user_id;
            $data['action_type'] = 4;
            AuditLog::create($data);
            $data = ['status' => 'success', 'data' => 'Audit Log reject action success'];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }

    public function actionDelete($model_name, $table_row_id, $user_id)
    {
        try {
            $entityInfoServices = new EntityInfoServices();
            $update_log = $entityInfoServices->getUpdateLog($model_name, $table_row_id);
            //            return  ['status' => 'success', 'data' => $update_log];
            $old_data = $this->getOldData($model_name, $table_row_id);
          //  return  $old_data;
            $data = [];
            $data['model_name'] = $model_name;
            $data['table_row_id'] = $table_row_id;
            $data['old_data'] = json_encode($old_data['data']);
            $data['responsible_user_id'] = $user_id;
            $data['action_type'] = 5;
            // return  ['status' => 'success', 'data' => $data['old_data']];   
            AuditLog::create($data);
            $data = ['status' => 'success', 'data' => 'Audit Log delete action success'];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }

    public function actionInactive($model_name, $table_row_id, $user_id)
    {
        try {
            $old_data = $this->getOldData($model_name, $table_row_id);

            $data = [];
            $data['model_name'] = $model_name;
            $data['table_row_id'] = $table_row_id;
            $data['old_data'] = json_encode($old_data['data']);
            $data['responsible_user_id'] = $user_id;
            $data['action_type'] = 6;
            AuditLog::create($data);
            $data = ['status' => 'success', 'data' => 'Audit Log inactive action success'];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }

    public function actionSuspend($model_name, $table_row_id, $user_id)
    {
        try {
            $old_data = $this->getOldData($model_name, $table_row_id);

            $data = [];
            $data['model_name'] = $model_name;
            $data['table_row_id'] = $table_row_id;
            $data['old_data'] = json_encode($old_data['data']);
            $data['responsible_user_id'] = $user_id;
            $data['action_type'] = 7;
            AuditLog::create($data);
            $data = ['status' => 'success', 'data' => 'Audit Log suspend action success'];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }

    public function actionActive($model_name, $table_row_id, $user_id)
    {
        try {
            $old_data = $this->getOldData($model_name, $table_row_id);

            $data = [];
            $data['model_name'] = $model_name;
            $data['table_row_id'] = $table_row_id;
            $data['old_data'] = json_encode($old_data['data']);
            $data['responsible_user_id'] = $user_id;
            $data['action_type'] = 8;
            AuditLog::create($data);
            $data = ['status' => 'success', 'data' => 'Audit Log active action success'];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }

    public function getOldData($model_name, $table_row_id)
    {
        //return $model_name;
        $data = [];
        switch ($model_name) {
            case "EntityTrainer":
                $entityTrainerServices = new EntityTrainerServices();
                $data = $entityTrainerServices->getTrainer($table_row_id);
                break;
            case "EntityAssessor":
                $entityAssessorServices = new EntityAssessorService();
                $data = $entityAssessorServices->getAssessor($table_row_id);
                break;
            case "XTranche":
                $trancheServices = new XTrancheServices();
                $data = $trancheServices->getTrancheInfo($table_row_id);
                break;
            case "XDayMessage":
                $xDayMessageServices = new XDayMessageServices();
                $data = $xDayMessageServices->getMessageInfo($table_row_id);
                break;
            case "XBank":
                $xbankServices = new XBankServices();
                $data = $xbankServices->getBankInfo($table_row_id);
                break;
            case "XMobileBanking":
                $xmobilebankServices = new XMobileBankingServices();
                $data = $xmobilebankServices->getBankInfo($table_row_id);
                break;
            case "XEthnicGroup":
                $ethnicServices = new xEthnicGroupServices();
                $data =    $ethnicServices->getGroupInfo($table_row_id);
                break;
            case "XCourseName":
                $courseAliasServices = new XCourseAliasServices();
                $data =    $courseAliasServices->getCourseAliasInfo($table_row_id);
                break;
            case "EntityInfo":
                $entityServices = new EntityInfoServices();
                $data = $entityServices->getEntityInfo($table_row_id);
                break;
            case "EntityTrancheContract":
                $contractServices = new EntityTrancheContractServices();
                $data = $contractServices->getEntityContractInfo($table_row_id);
                break;
            case "EntityTrainingTarget":
                $targetServices = new EntityTrainingTargetServices();
                $data = $targetServices->getTargetInfo($table_row_id);
                break;
            case "TrainingInstituteInfo":
                $instituteServices = new TrainingInstituteInfoServices();
                $data = $instituteServices->getTrainingInstituteInfo($table_row_id);
                break;
            case "CourseInfo":
                $courseServices = new CourseInfoServices();
                $data = $courseServices->getsingleCourseDetails($table_row_id);
                break;
            case "CourseType":
                $coursServices = new XCourseTypeServices();
                $data = $coursServices->getCourseTypeInfo($table_row_id);
                break;
            case "CourseCategory":
                $coursServices = new XCourseCategoryService();
                $data = $coursServices->getCourseCategoryInfo($table_row_id);
                break;
            case "CourseSector":
                $coursServices = new XCourseSectorService();
                $data = $coursServices->getCourseSectorInfo($table_row_id);
                break;
            case "TrainningMilestone":
                $coursServices = new TrainningMilestoneService();
                $data = $coursServices->getMilestoneInfo($table_row_id);
                break;
            case "EntityType":
                $entityServices = new EntityTypeServices();
                $data = $entityServices->getEntityTypeInfo($table_row_id);
                break;
            case "XIndustrySector":
                $industryServices = new XIndustrySectorServices();
                $data = $industryServices->getIndustrySectorInfo($table_row_id);
                break;
            case "GeoDivision":
                $geoServices = new GeoDivisionServices();
                $data = $geoServices->getDivisionInfo($table_row_id);
                break;
            case "GeoDistrict":
                $geoServices = new GeoDistrictServices();
                $data = $geoServices->getDistrictInfo($table_row_id);
                break;
            case "GeoUpazila":
                $geoServices = new GeoUpazilaServices();
                $data = $geoServices->getUpazilaInfo($table_row_id);
                break;
            case "InstituteCourseTarget":
                $targetServices = new EntityTrainingTargetServices();
                $data = $targetServices->getTargetInfo($table_row_id);
                break;
            case "BatchInfo":
                $targetServices = new BatchInfoServices();
                $data = $targetServices->getsingleBatchDetails($table_row_id);
                break;
            case "TrainingPaymentEnrollment":
                $targetServices = new TrainingPaymentEnrollmentServices();
                $data = $targetServices->getsingleBatchDetails($table_row_id);
                break;
            case "TrainingAssessment":
                
                $data = TrainingAssessment::Where('batch_info_id', $table_row_id)->get();
                break;
            case "TraineeEmployment":  
                $data = TraineeEmployment::Where('batch_info_id', $table_row_id)->get();
                break;
            default:
                $data = [];
        }

        return $data;
    }

    public function searchLog(Request $request)
    {
        try {
            $entity_type = $request->entity_type;
            $user_id = $request->user_id;
            $query = AuditLog::query();
            $query->when($entity_type, function ($q, $entity_type) {
                return $q->where('model_name', $entity_type);
            });
            $query->when($user_id, function ($q, $user_id) {
                return $q->where('responsible_user_id', $user_id);
            });
            $audit = $query->with('user_info.employee')->orderBy('table_row_id', 'ASC')->get();
            $data = ['status' => 'success', 'data' => $audit];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;
    }
}
