<?php

namespace App\Services;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DoptorApiServices
{
    public function getOfficeLayer(Request $request): array
    {

        try {
            $complainant_id = $request->complainant_id;
            $token = $this->doptorLogin();
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://n-doptor-api-stage.nothi.gov.bd/api/custom-layer-level',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                // CURLOPT_POSTFIELDS => json_encode([]),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $token,
                    'api-version: 1',
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $data = json_decode($response, true);

            if(isset($data['status'])){
                $data = 'No data found.';
            }

            $data = ['status' => 'success', 'data' =>  $data];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
            return $data;
        }
        return $data;

    }
    public function getApiData(Request $request): array
    {

        try {
            $api_url = $request->api_url;
            $api_type = $request->api_type;
            $token = $this->doptorLogin();
            $curl = curl_init();
            //return $data = ['status' => 'success', 'data' =>  $request];
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://n-doptor-api-stage.nothi.gov.bd/api/'.$api_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $api_type,
                CURLOPT_POSTFIELDS => json_encode($request->all()),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $token,
                    'api-version: 1',
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $data = json_decode($response, true);

            if(isset($data['status']) && $data['status']== 'error'){
                $data = 'No data found.';
            }

            $data = ['status' => 'success', 'data' =>  $data['data']];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;

    }

    public function getDoptorOffice(Request $request): array
    {

        try {
            $token = $this->doptorLogin();
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://n-doptor-api-stage.nothi.gov.bd/api/v1/office?'.$request->prams,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                // CURLOPT_POSTFIELDS => json_encode($request->all()),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $token,
                    'api-version: 1',
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $data = json_decode($response, true);

            if(isset($data['status'])){
                $data = 'No data found.';
            }

            $data = ['status' => 'success', 'data' =>  $data];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;

    }
    public function getDoptorOfficeInfo($prams): array
    {

        try {
            $token = $this->doptorLogin();
            $curl = curl_init();
            //return $data = ['status' => 'success', 'data' =>  $request];
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://n-doptor-api-stage.nothi.gov.bd/api/v1/office?'.$prams,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                // CURLOPT_POSTFIELDS => json_encode($request->all()),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $token,
                    'api-version: 1',
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $data = json_decode($response, true);

            if(isset($data['status'])){
                $data = 'No data found.';
            }

            $data = ['status' => 'success', 'data' =>  $data];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;

    }
    public function getDoptorData($url, $prams): array
    {

        try {
            $token = $this->doptorLogin();
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://n-doptor-api-stage.nothi.gov.bd/api/v1/'.$url.'?'.$prams,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $token,
                    'api-version: 1',
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $data = json_decode($response, true);
            if(isset($data['status'])){
                $data = 'No data found.';
            }
            $data = ['status' => 'success', 'data' =>  $data];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;

    }
    public function administrativeLogin($token): array
    {

        try {
            $curl = curl_init();
            //return $data = ['status' => 'success', 'data' =>  $request];
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://n-doptor-api-stage.nothi.gov.bd/api/user/me',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                // CURLOPT_POSTFIELDS => json_encode($request->all()),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $token,
                    'api-version: 1',
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $data = json_decode($response, true);

            $data = ['status' => 'success', 'data' =>  $data['data']];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
        }
        return $data;

    }

    public function doptorLogin()
    {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://n-doptor-api-stage.nothi.gov.bd/api/client/login',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode(['client_id'=>'nothi123','username' => 'seipfd', 'password' => '123456']),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $data = json_decode($response, true);
            $tokenData = $data['data'];
            return $tokenData['token'];
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'data' => $exception->getMessage()];
            return $data;
        }

    }




}
