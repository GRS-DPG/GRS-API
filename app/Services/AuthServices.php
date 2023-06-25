<?php

namespace App\Services;


use App\Models\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Mail\ResetPassword;


class AuthServices
{

  public function sendPassResetMail($passResetData)
  {
    try {
      $resetPassData = Mail::to($passResetData['email'])->send(new ResetPassword($passResetData));
    } catch (\Exception $exception) {
      return $exception->getMessage();
    }

    return $resetPassData;
  }

  public function savePassResetToken($token, $email)
  {

    try {
      $data = [];
      $data['email'] = $email;
      $data['token'] = $token;
      $saveToken = PasswordReset::create($data);
      return $saveToken;
    } catch (\Exception $exception) {

      return $exception->getMessage();
    }
  }
  public function tokenValidtion($token)
  {


    try {
      $response = PasswordReset::where('token', $token)->first();
      return $response;
    } catch (\Exception $exception) {

      return $exception->getMessage();
    }
  }
  public function deleteToken($token)
  {


    try {
      $response = PasswordReset::where('token', $token)->delete();
      return $response;
    } catch (\Exception $exception) {

      return $exception->getMessage();
    }
  }
  public function changePass($user_info, $request)
  {

    if (!$user_info) {
      return response()->json(responseFormat('error',  'User Not Found!'));
    } else {
      if ($request->password === $request->password_confirmation) {

        try {

          $password = Hash::make($request->password);
          $next_expiry_date = Date('Y-m-d', strtotime('+90 days'));

          User::where('email', $user_info->email)->update([
            'password' => $password,
            'password_expiry_date' => $next_expiry_date
          ]);

          return ['status' => 'success', 'data' => 'Password Changed Successfully'];
          DB::commit();
        } catch (\Exception $exception) {
          DB::rollback();
          return ['status' => 'error', 'data' => $exception->getMessage()];
        }
      } else {
        response()->json(responseFormat('error',  'Password and Confirm Password Not Match'));
      }
    }
  }
}
