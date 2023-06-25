<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use App\Models\Complainant;
use Exception;
use App\Http\Requests\AuthRequest\ChangePassRequest;
use App\Models\LoginHistory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;
use App\Services\AuthServices;
use App\Services\DoptorApiServices;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        Validator::make($request->all(), ['username' => 'string|required', 'password' => 'string|required'])->validate();

        try {


            $user = Complainant::where('username', $request->username)->where('is_authenticated', 1)->first();

            if (!$user) {
                return response()->json(responseFormat('error', 'Mobile No Not Found!'),422);

            }

            if (Hash::check($request->password, $user->password)) {

                $user_info = Complainant::where('username', $request->username)->first();

                $token_response = $this->makeCagToken($user_info->toArray() + [
                    'device_id' => $request->device_id,
                    'device_type' => $request->device_type,

                ]);
                if (!isSuccessResponse($token_response)) {
                    return response()->json(responseFormat('error', 'Token Generation Error'),422);

                }

                $login_info = [
                    'user_info' => $user_info, 'token' => $token_response['data'],
                ];

                    return response()->json(responseFormat('success', $login_info));

            } else {
                return response()->json(responseFormat('error', 'Mobile No or Pin Not Match!'),422);
                //throw new \Exception('Mobile or Pin Not Match!');
            }
        } catch (\Exception $exception) {
            return response()->json(responseFormat('error', $exception));
        }
    }
    public function administrativeLogin(Request $request, DoptorApiServices $doptorApiServices)
    {

        try {
            if ($request->token) {

                $token = base64_decode($request->token);
                $token_info = json_decode($token);

                $user_info = $doptorApiServices->administrativeLogin($token_info->token);
                if($user_info && $user_info['status'] == 'success'){
                    $user_info = $user_info['data'];
                }


                // return response()->json(responseFormat('success', [
                //     'device_id' => 1,
                //     'device_type' => 'web',
                //     'email' => $user_info['user']['username'],
                //     'user_id' => $user_info['user']['id'],

                // ]));

                $token_response = $this->makeCagToken([
                    'device_id' => 1,
                    'device_type' => 'web',
                    'email' => $user_info['user']['username'],
                    'id' => $user_info['user']['id'],

                ]);

                if (!isSuccessResponse($token_response)) {
                    return response()->json(responseFormat('error', 'Token Generation Error'),422);

                }

                $login_info = [
                    'user_info' => $user_info, 'token' => $token_response['data'],
                ];

                    return response()->json(responseFormat('success', $login_info));

            } else {
                return response()->json(responseFormat('error', 'Token not found'),422);
            }
        } catch (\Exception $exception) {
            return response()->json(responseFormat('error', $exception));
        }
    }
    public function test(Request $request, AuthServices $authServices): \Illuminate\Http\JsonResponse
    {
            $response = response()->json(responseFormat('success',  'You are auth user!'));
            return $response;
    }
    // public function forgotPass(Request $request, AuthServices $authServices): \Illuminate\Http\JsonResponse
    // {
    //     $user = User::where('email', $request->email)->first();

    //     if (!$user) {
    //         return response()->json(responseFormat('error',  'User Not Found!'));
    //     } else {
    //         $userName = Employee::where('user_id', $user->id)->first();

    //         // generate token
    //         $token_response = $this->makeCagToken($user->toArray() + [
    //             'device_id' => $request->device_id,
    //             'device_type' => $request->device_type,
    //         ]);
    //         // var_dump($token_response);

    //         $resetUrl = 'https://seip-doptor.tappware.com/resetPassword/' . $token_response['data'];
    //         // send email with reseturl + save user email and token in db for security
    //         $passResetData = [
    //             'resetlink' => $resetUrl,
    //             'email' => $user->email,
    //             'name' => $userName->name
    //         ];
    //         $sendMail = $authServices->sendPassResetMail($passResetData);
    //         $saveToken = $authServices->savePassResetToken($token_response['data'], $user->email);

    //         $response = response()->json(responseFormat('success',  'Please check your email address for new password.'));
    //         return $response;
    //     }
    // }
    // public function resetPass(ChangePassRequest $request, AuthServices $authServices)
    // {
    //     try {
    //         //  get token , pass , confirmpass
    //         $token = $request->token;
    //         $tokenValidate = $authServices->tokenValidtion($token);

    //         // find user and update password
    //         $user_info = User::where('email',   $tokenValidate['email'])->first();

    //         $changePass = $authServices->changePass($user_info, $request);
    //         // delete the token from db
    //         $deleteToken = $authServices->deleteToken($token);
    //         $response = response()->json(responseFormat('success',  'Password Changed Successfully'));
    //         return $response;
    //     } catch (\Exception $exception) {

    //         return $exception->getMessage();
    //     }
    // }


    protected function makeCagToken($data): array
    {
        try {
            $token_data = $this->setLoginTokenData([
                'device_id' => $data['device_id'],
                'device_type' => $data['device_type'],
                'email' => $data['email'],
                'user_id' => $data['id'],
            ]);
            $token_response = $this->generateToken($token_data);
            return ['status' => 'success', 'data' => $token_response];
        } catch (\Exception $ex) {
            return responseFormat(
                'error',
                __('Technical Error Happen. Error: MCT'),
                ['details' => $ex->getMessage(), 'code' => $ex->getCode()]
            );
        }
    }

    protected function setLoginTokenData($data)
    {
        if (!empty($data)) {
            $data_2_unset = [];
            $data_2_change = $this->getLoginTokenParams();
            foreach ($data as $data_key => $data_val) {
                if (isset($data_2_change[$data_key])) {
                    $data[$data_2_change[$data_key]] = is_array($data_val) ? makeEncryptedData(json_encode($data_val)) : makeEncryptedData($data_val);
                    $data_2_unset[] = $data_key;
                }
            }
            if (!empty($data_2_unset)) {
                foreach ($data_2_unset as $unset) {
                    unset($data[$unset]);
                }
            }
        }
        return $data;
    }
}
