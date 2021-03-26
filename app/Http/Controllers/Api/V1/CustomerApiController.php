<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Models\Computer;
use App\Models\ComputerDevices;
use App\Models\ComputerGroup;
use App\Models\Customer;
use App\Models\Device;
use App\Models\Group;
use App\Models\Resource;
use App\Models\User;
use App\Models\UserComputers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerApiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
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
        $wan_ip_addr = $request->ip();

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
            $count = Computer::where('id', '>', -1)->count() + 1;
            $code = '1' . substr("0000{$count}", -5);
            $computer->code = $code;
        }

        $computer->serial_number = $serial_number;
        $computer->ip_address = $ip_address;
        $computer->wan_ip_addr = $wan_ip_addr;
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
        $response['computer'] = $computer;

        return response()->json($response);
    }

    public function updateAllPhones(Request $request)
    {
        $user = auth()->user();
        $computer = Computer::where('code', $user->computer_id)->first();
        $deviceList = $request->devices;
        $needCreateRelation = false;

        foreach ($deviceList as $deviceItem) {
            $device = Device::where('serial', $deviceItem['serial'])->first();
            if ($device == null) {
                $device = new Device();
                $needCreateRelation = true;
            }
            
            $device->no = $deviceItem['no'];
            $device->ip = $deviceItem['ip'];
            $device->ram = $deviceItem['ram'];
            $device->name = $deviceItem['name'];
            $device->imei =  $deviceItem['imei'];
            $device->root = $deviceItem['root'];
            $device->size = $deviceItem['size'];
            $device->model = $deviceItem['model'];
            $device->serial = $deviceItem['serial'];
            $device->number = $deviceItem['number'];
            $device->brand = $deviceItem['brand'];
            $device->status = $deviceItem['status'];
            $device->version = $deviceItem['version'];
            $device->group_id = $deviceItem['group_id'];
            $device->save();

            if ($needCreateRelation) {
                $computerDevice = new ComputerDevices();
                $computerDevice->device_id = $device->id;
                $computerDevice->computer_id = $computer->id;
                $computerDevice->save();
            }
        }

        $response = [];
        $response['success'] = true;
        $response['message'] = "Update Finished";

        return response()->json($response);
    }

    public function updateAllGroups(Request $request) {
        $groupList = $request->groups;
        $user = auth()->user();
        $computer = Computer::where('code', $user->computer_id)->first();
        $needCreateRelation = false;
        foreach ($groupList as $groupItem) {
            $group = Group::where('uuid', $groupItem['uuid'])->first();
            if ($group == null) {
                $group = new Group();
                $needCreateRelation = true;
            }
            
            $group->uuid = $groupItem['uuid'];
            $group->name = $groupItem['name'];
            $group->is_deleted = $groupItem['is_deleted'];
            $group->save();

            if ($needCreateRelation) {
                $computerGroup = new ComputerGroup();
                $computerGroup->group_id = $group->id;
                $computerGroup->computer_id = $computer->id;
                $computerGroup->save();
            }
        }

        $response = [];
        $response['success'] = true;
        $response['message'] = "Update Finished";

        return response()->json($response);
    }

    public function getAllPhones()
    {
        $user = auth()->user();
        $computer = Computer::where('code', $user->computer_id)->first();
        $deviceList = [];
        foreach ($computer->rComputerDevices as $computerDevice) {
            $device = $computerDevice->rDevice;
            $data = [];
            $data['id'] = $device->id;
            $data['no'] = $device->no;
            $data['ip'] = $device->ip;
            $data['ram'] = $device->ram;
            $data['name'] = $device->name;
            $data['imei'] = $device->imei;
            $data['root'] = $device->root;
            $data['size'] = $device->size;
            $data['model'] = $device->model;
            $data['serial'] = $device->serial;
            $data['number'] = $device->number;
            $data['brand'] = $device->brand;
            $data['status'] = $device->status;
            $data['version'] = $device->version;
            $data['group_id'] = $device->group_id;

            array_push($deviceList, $data);
        }

        $response = [];
        $response['success'] = true;
        $response['devices'] = $deviceList;

        return response()->json($response);
    }

    public function getAllGroups() {
        $user = auth()->user();
        $computer = Computer::where('code', $user->computer_id)->first();
        $groupList = [];
        foreach ($computer->rComputerGroups as $computerGroup) {
            $group = $computerGroup->rGroup;
            $data = [];
            $data['is_deleted'] = $group->is_deleted;
            $data['uuid'] = $group->uuid;
            $data['name'] = $group->name;

            array_push($groupList, $data);
        }

        $response = [];
        $response['success'] = true;
        $response['groups'] = $groupList;

        return response()->json($response);
    }

    public function findComputer(Request $request)
    {
        $response = [];
        $computer_id = $request->computer_id;

        $computer = Computer::where('code', $computer_id)->first();
        if ($computer == null) {
            $response['success'] = false;
            $response['message'] = 'Not Found Computer';
            return response()->json($response);
        }

        $response['success'] = true;
        $response['computer'] = $computer;

        return response()->json($response);
    }

    public function getResources() {
        $cond = Resource::where('id', '>', -1);
        $resources = $cond->get();

        $deviceList = [];
        foreach ($resources as $resource) {
            $data = [];
            $data['id'] = $resource->id;
            $data['name'] = $resource->name;
            $data['size'] = $resource->size;
            $data['created_at'] = $resource->created_at;

            array_push($deviceList, $data);
        }

        $response['success'] = true;
        $response['resources'] = $deviceList;

        return response()->json($response);
    }

    public function resourceDownload($id) {
        $resource = Resource::where('id', $id)->first();
        $fileName = $resource->name;
        $filePath = resource_path().'/'.'js/temp'.'/'.$fileName;
        return response()->download($filePath, $fileName); 
    }
}
