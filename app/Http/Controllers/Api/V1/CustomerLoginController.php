<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Computer;
use App\Models\User;
use App\Models\UserComputers;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CustomerLoginController extends Controller {

    public function register(Request $request)  {
        $name = $request->name;
        $email   = $request->email;
        $password    = $request->password;
        $serial_number = $request->serial_number;
        $ip_address = $request->ip_address;

        $user = User::where('email', $email)->first();

        if ($user != null) {
            $response = ['success' => false, 'message' => '已经使用了用户名。'];
            return response()->json($response);
        }

        $computer = Computer::where('serial_number', $serial_number)->first();

        if ($computer == null) {
            $computer = new Computer();
        }

        $computer->ip_address = $ip_address;
        $computer->serial_number = $serial_number;
        $computer->save();

        $user_count = User::where('id', '>', '-1')->count() + 1;
        $str_length = 5;
        $code = 'XMB' . substr("0000{$user_count}", -$str_length);

        $user = new User();
        $user->name = $name;
        $user->password = $password;
        $user->email = $request->email;
        $user->remember_token = Str::random(60);
        $user->expire_at = Carbon::now()->addDays(90);
        $user->save();

        $user_computer = UserComputers::where('computer_id', $computer->id)->first();
        if ($user_computer == null) {
            $user_computer = new UserComputers();
            $user_computer->computer_id = $computer->id;
        }

        $user_computer->user_id = $user->id;
        $user_computer->save();
        
        $response = [];
        $response['success'] = true;
        $response['token'] = $user->remember_token;
        $response['user'] = $user;

        return response()->json($response);
    }

    public function login(Request $request)  {
        $email   = $request->email;
        $password    = $request->password;
        $serial_number = $request->serial_number;
        $ip_address = $request->ip_address;

        $user = User::where('email', $email)->first();

        if ($user == null) {
            $response = ['success' => false, 'message' => '不存在用户名。'];
            return response()->json($response);
        }

        if ($password == $user->password) {

            $expire_date = $user->expire_at;
            $current = new Carbon;
            if ($current > $expire_date) {
                return response()->json(['success' => false, 'message' => '使用期限已满。']);
            }

            $computer = Computer::where('serial_number', $serial_number)->first();
            if ($computer == null) {
                $computer = new Computer();
            }

            $computer->ip_address = $ip_address;
            $computer->serial_number = $serial_number;
            $computer->save();

            $user_computer = UserComputers::where('computer_id', $computer->id)->first();
            if ($user_computer == null) {
                $user_computer = new UserComputers();
                $user_computer->computer_id = $computer->id;
            }

            $user_computer->user_id = $user->id;
            $user_computer->save();

            $response['success'] = true;
            $response['token'] = $user->remember_token;
            $response['user'] = $user;

            return response()->json($response);
        }

        return response()->json(['success' => false, 'message' => '密码错了。请您再试一次。']);
    }

}