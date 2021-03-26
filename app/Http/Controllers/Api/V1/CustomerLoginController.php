<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Computer;
use App\Models\Customer;
use App\Models\User;
use App\Models\UserComputers;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Claims\Custom;
use Tymon\JWTAuth\Facades\JWTAuth as JWTAuth;

class CustomerLoginController extends Controller {

    public function register(Request $request)  {
        $email   = $request->email;
        $username = $request->username;
        $password    = $request->password;
        $ip_address = $request->ip_address;
        $wan_ip_addr = $request->ip();

        $user = Customer::where('username', $username)->first();
        if ($user != null) {
            $response = ['success' => false, 'message' => '已经使用了用户名。'];
            return response()->json($response);
        }

        $user = Customer::where('email', $email)->first();
        if ($user != null) {
            $response = ['success' => false, 'message' => '已经使用了电邮地址。'];
            return response()->json($response);
        }

        $user = new Customer();
        $user->email = $email;
        $user->username = $username;
        $user->password = Hash::make($password);

        $count = Computer::where('id', '>', -1)->count() + 1;
        $code = '1' . substr("0000{$count}", -5);
        $user->computer_id = $code;
        $user->save();
        
        $token = JWTAuth::fromUser($user, ['exp' => Carbon::now()->addDays(7)->timestamp]);

        $computer = Computer::where('code', $code)->first();
        if ($computer == null) {
            $computer = new Computer();
        }

        $computer->code = $code;
        $computer->ip_address = $ip_address;
        $computer->wan_ip_addr = $wan_ip_addr;
        $computer->save();
        
        $response = [];
        $response['success'] = true;
        $response['token'] = $token;
        $response['token_type'] = 'bearer';
        $response['user'] = $user;

        return response()->json($response);
    }

    public function login(Request $request)  {
        $email   = $request->email;
        $password    = $request->password;
        $ip_address = $request->ip_address;
        $wan_ip_addr = $request->ip();

        $user = Customer::where('email', $email)->first();
        if ($user == null) {
            $user = Customer::where('username', $email)->first();
            if ($user == null) {
                $response = ['success' => false, 'message' => '不存在用户名或电邮地址。'];
                return response()->json($response);
            }
        }

        if (Hash::check($password, $user->password)) {
            $computer = Computer::where('code', $user->computer_id)->first();
            if ($computer == null) {
                $computer = new Computer();
                $count = Computer::where('id', '>', -1)->count() + 1;
                $code = '1' . substr("0000{$count}", -5);
                $computer->code = $code;
            }

            $computer->ip_address = $ip_address;
            $computer->wan_ip_addr = $wan_ip_addr;
            $computer->save();

            $token = JWTAuth::fromUser($user, ['exp' => Carbon::now()->addDays(7)->timestamp]);
            
            $response['success'] = true;
            $response['token'] = $token;
            $response['token_type'] = 'bearer';
            $response['user'] = $user;

            return response()->json($response);
        }

        return response()->json(['success' => false, 'message' => '密码错了。请您再试一次。']);
    }

}