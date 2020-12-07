<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Models\Computer;
use App\Models\ComputerDevices;
use App\Models\Device;
use App\Models\User;
use App\Models\UserComputers;
use Illuminate\Http\Request;

class CustomerApiController extends Controller
{

    public function getUser(Request $request)
    {
        $token = $request->token;
        if ($token == null) {
            return null;
        }

        $user = User::where('remember_token', $token)->first();
        return $user;
    }

    public function registerComputer(Request $request)
    {
        $response = [];
        $user = $this->getUser($request);

        if ($user == null) {
            $response['success'] = false;
            $response['message'] = 'Token is missing!';
            return response()->json($response);
        }

        $serial_number = $request->serial_number;
        $ip_address = $request->ip_address;

        if ($serial_number == null) {
            $response['success'] = false;
            $response['message'] = 'Your PC\'s Serial Number is missing';
            return response()->json($response);
        }

        if ($ip_address == null) {
            $response['success'] = false;
            $response['message'] = 'Your PC\'s IP Address is missing';
            return response()->json($response);
        }

        $computer = Computer::where('serial_number', $serial_number)->first();

        if ($computer == null) {
            $computer = new Computer();
        }

        $computer->serial_number = $serial_number;
        $computer->ip_address = $ip_address;
        $computer->save();

        $data = UserComputers::where('computer_id', $computer->id)->first();
        if ($data == null) {
            $data = new UserComputers();
        }

        $data->user_id = $user->id;
        $data->computer_id = $computer->id;
        $data->save();

        $phone_serial = $request->phone_serial;
        $phone_ip = $request->phone_ip;

        if ($phone_serial != null) {
            $phoneData = Device::where('serial_number', $phone_serial)->first();
            if ($phoneData == null) {
                $phoneData = new Device();
            }

            $phoneData->serial_number = $phone_serial;
            $phoneData->ip_address = $phone_ip;
            $phoneData->save();

            $relateData = ComputerDevices::where('device_id', $phoneData->id)->first();

            if ($relateData == null) {
                $relateData = new ComputerDevices();
            }

            $relateData->computer_id = $computer->id;
            $relateData->device_id = $phoneData->id;
            $relateData->save();
        }

        $response['success'] = true;


        return response()->json($response);
    }

    public function getAllComputers()
    {
        $computers = \App\Models\Computer::all();
        return $computers;
    }

    public function findComputer(Request $request)
    {
        $response = [];
        $serial_number = $request->serial_number;

        $phoneData = Device::where('serial_number', $serial_number)->first();
        if ($phoneData == null) {
            $response['success'] = false;
            $response['message'] = 'Phone did not registered any computer';
            return response()->json($response);
        }

        $relateData = ComputerDevices::where('device_id', $phoneData->id)->first();

        if ($relateData == null) {
            $response['success'] = false;
            $response['message'] = 'Phone did not registered any computer';
            return response()->json($response);
        }

        $computer = Computer::where('id', $relateData->computer_id)->first();
        if ($computer == null) {
            $response['success'] = false;
            $response['message'] = 'Not Found Computer';
            return response()->json($response);
        }

        $response['success'] = true;
        $response['computer'] = $computer;

        return response()->json($response);
    }
}
