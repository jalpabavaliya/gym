<?php

namespace App\CPU;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\admin;
use App\Models\detail;
use App\Models\workers;

class Helpers
{
    public static function module_permission_check($mod_name)
    {
        $permission = auth('admin')->user()->module_access;
        if (isset($permission) && in_array($mod_name, (array)json_decode($permission)) == true) {
            return true;
        }

        if (auth('admin')->user()->role_id == 0 || auth('admin')->user()->role_id == 1) {
            return true;
        }
        return false;
    }

    public static function error_processor($validator)
    {
        $err_keeper = [];
        foreach ($validator->errors()->getMessages() as $index => $error) {
            array_push($err_keeper, ['code' => $index, 'message' => $error[0]]);
        }
        return $err_keeper;
    }

    public static function get_worker_by_token($request)
    {
        $data = '';
        $success = 0;

        $token = explode(' ', $request->header('authorization'));
        if (count($token) > 1 && strlen($token[1]) > 30) {
            $worker = workers::where(['auth_token' => $token['1']])->first();
            if (isset($worker)) {
                $data = $worker;
                $success = 1;
            }
        }

        return [
            'success' => $success,
            'data' => $data
        ];
    }

    public static function get_customer($request = null)
    {
        $user = null;
        if (auth()->check()) {
            $user = auth()->user(); // for web
        } elseif ($request != null && $request->user() != null) {
            $user = $request->user(); //for api
        } elseif (session()->has('id')) {
            $user = User::find(session('id'));
        }

        if ($user == null) {
            $user = 'offline';
        }

        return $user;
    }

    public static function send_to_device($is_user, $fcm_token, $data)
    {
        if ($is_user == 'user') {
            $key = detail::first()->user_key;
        } else {
            $key = detail::first()->restaurant_key;
        }

        $url = "https://fcm.googleapis.com/fcm/send";
        $header = array(
            "authorization: key=" . $key . "",
            "content-type: application/json"
        );

        $postdata = '{
            "to" : "' . $fcm_token . '",
            "data" : {
                "title" :"' . $data['title'] . '",
                "body" : "' . $data['description'] . '",
                "is_read": 0
              },
              "notification" : {
                "title" :"' . $data['title'] . '",
                "body" : "' . $data['description'] . '",
                "is_read": 0,
                "icon" : "new",
                "sound" : "default"
              }
        }';

        $ch = curl_init();
        $timeout = 120;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        // Get URL content
        $result = curl_exec($ch);
        // close handle to release resources
        curl_close($ch);

        return $result;
    }

    public static function send_to_device_topic($is_user, $topic, $data)
    {
        if ($is_user == 'user') {
            $key = detail::first()->user_key;
        } else {
            $key = detail::first()->restaurant_key;
        }

        $url = "https://fcm.googleapis.com/fcm/send";
        $header = [
            "authorization: key=" . $key . "",
            "content-type: application/json",
        ];

        $postdata = '{
            "to" : "/topics/' . $topic . '",
            "data" : {
                "title":"' . $data['title'] . '",
                "body" : "' . $data['description'] . '",
                "is_read": 0
              },
              "notification" : {
                "title":"' . $data['title'] . '",
                "body" : "' . $data['description'] . '",
                "is_read": 0,
                "icon" : "new",
                "sound" : "default"
              }
        }';

        $ch = curl_init();
        $timeout = 120;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        // Get URL content
        $result = curl_exec($ch);
        // close handle to release resources
        curl_close($ch);
        return $result;
    }

    public static function otp($receiver, $otp)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://sms.unitechitsolution.in:6005/api/v2/SendSMS?SenderId=UNITCH&Is_Unicode=false&Is_Flash=false&Message=Dear%20user%20' . $otp . '%20is%20your%20Unitech%20IT%20Solution%20verification%20code%2C%20thank%20you%20for%20registration.&MobileNumbers=91' . $receiver . '&ApiKey=AI2aF6zxu1Mtv0NcUYKzkNxa%20Sb86MmfiLXLObO0mDQ%3D&ClientId=85d288ac-b598-4627-a46e-0696f0446bcd',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0),
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0),
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public static function displaywords($amount)
    {
        $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
        // Check if there is any number after decimal
        $amt_hundred = null;
        $count_length = strlen($num);
        $x = 0;
        $string = array();
        $change_words = array(
            0 => '', 1 => 'One', 2 => 'Two',
            3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
            7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
            10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
            13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
            16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
            19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
            40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
            70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety'
        );
        $here_digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
        while ($x < $count_length) {
            $get_divider = ($x == 2) ? 10 : 100;
            $amount = floor($num % $get_divider);
            $num = floor($num / $get_divider);
            $x += $get_divider == 10 ? 1 : 2;
            if ($amount) {
                $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
                $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
                $string[] = ($amount < 21) ? $change_words[$amount] . ' ' . $here_digits[$counter] . $add_plural . ' 
            ' . $amt_hundred : $change_words[floor($amount / 10) * 10] . ' ' . $change_words[$amount % 10] . ' 
            ' . $here_digits[$counter] . $add_plural . ' ' . $amt_hundred;
            } else $string[] = null;
        }
        $implode_to_Rupees = implode('', array_reverse($string));
        $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
        " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
        return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise;
    }
}
