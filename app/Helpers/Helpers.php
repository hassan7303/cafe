<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class Helpers
{
    protected $prefix = '50';
    public static function error($message, $errorCode, $httpCode = 200)
    {
        return response()->json([
            'status' => false,
            'snackbar' => [
                'type' => "error",
                "code" => $errorCode,
                'message' => $message . " error :" . $errorCode,
            ],
        ], $httpCode);
    }
    public static function successRequest($data = null, $message = null)
    {
        if (!empty($data) && !empty($message)) {
            return response()->json([
                'status' => true,
                'snackbar' => [
                    'type' => "success",
                    'message' => $message,
                ],
                'data' => $data
            ], 200);
        }
        if (!empty($message)) {
            return response()->json([
                "status" => true,
                'snackbar' => [
                    'type' => "success",
                    'message' => $message
                ],
            ], 200);
        }
        if (!empty($data)) {
            return response()->json([
                'status' => true,
                'data' => $data
            ], 200);
        }
        return [
            "status" => true
        ];
    }
    public static function sendSMS($phone)
    {
        $data = [
            "mobile" => '0' . substr($phone, -10),
            "method" => "sms",
            "templateID" => 6,
            "length" => 5,
            "params" => [
                "خوش امدید",
                "msgway.com"
            ],
            "expireTime" => 60
        ];
        $response = Http::withHeaders(["apiKey" => env('SMS_API_KEY')])->post(env('SMS_API_URL'), $data)->json();
        if ($response['status'] === 'error' || empty($response)) {
            Log::error($response['error']['message'] . self::$prefix . __LINE__);
            return Helpers::error('sms conection error', self::$prefix . __LINE__);
        }
        return Helpers::successRequest();
    }
    public static function vereFaySMS($phone, $code)
    {
        $params = [
            "OTP" => $code,
            "mobile" => '0' . substr($phone, -10),
        ];
        $response = Http::withHeaders(["apiKey" => env('SMS_API_KEY')])->post(env('SMS_VEREFAY_URL'), $params);
        if ($response['status'] === 'error' || empty($response)) {
            Log::error($response['error']['message'] . self::$prefix . __LINE__);
            return Helpers::error('sms conection error', self::$prefix . __LINE__);
        }
        return Helpers::successRequest();
    }
}