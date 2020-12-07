<?php

namespace App\Http\Controllers;

use App\AppResources;
use App\Apps;
use App\DeviceType;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use laraveldes3\Des3 as DES3;

class ManageResourceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cond = Resource::where('id', '>', -1);
        $resources = $cond->get();

        $deviceList = [];
        foreach ($resources as $resource) {
            $data = [];
            $data['id'] = $resource->id;
            $data['app_id'] = $resource->app_id;
            $data['type_id'] = $resource->type_id;
            $data['created_at'] = $resource->created_at;

            array_push($deviceList, $data);
        }

        return view('devicetype', array('types' => $deviceList));
    }

    public function getResources($typeId)
    {

        $cond = Resource::where('type_id', $typeId);
        $resources = $cond->get();

        $appIds = [];
        $resourceList = [];

        foreach ($resources as $resource) {
            $data = [];
            $data['id'] = $resource->id;
            $data['app_id'] = $resource->app_id;
            $data['name'] = $resource->rApp->name;
            $data['type'] = $resource->rDeviceType->name;
            $data['updated_at'] = $resource->updated_at;

            array_push($resourceList, $data);
            array_push($appIds, $resource->app_id);
        }

        $appsHasRes = DB::table('apps')->whereNotIn('id', $appIds)->get();
        $apps = DB::table('apps')->where('is_deleted', false)->orderBy('id')->get();

        return view('resources', array(
            'resources' => $resourceList,
            'typeId' => $typeId,
            'appsHasRes' => $appsHasRes,
            'apps' => $apps
        ));
    }

    public function uploadResource(Request $request)
    {
        $app_id   = $request->app_list;
        $type_id  = $request->type_id;

        $cond = AppResources::where('app_id', $app_id);
        $resource = $cond->where('type_id', $type_id)->first();

        if ($resource != null) {
            return response()->json($resource);//['success'=>false, 'message'=>'resource already exist']);
        }

        $filename = $app_id;

        $file = $request->file('file');

        // Save File To Public Storage
        $tempLocation = storage_path().'/'.'app/public/temp';
        $file->storeAs('public/temp', $filename);

        // Get File and Encrypt Content
        $content = File::get($tempLocation.'/'.$filename);

        $DES3_KEY = env('XCS_SECRET', 'LbGqH750ukm7g2fbWqzDbQ5L');
        $DES3_IV = env('XCS_IV', 'jefQJhKG');

        $encrypt = openssl_encrypt($content, "des-ede3-cbc", $DES3_KEY, OPENSSL_RAW_DATA, $DES3_IV);
        
        // Save Encrypted File To Public Storage
        Storage::put('public/app/js/'.$filename, $encrypt);

        // Move File To Resource From Public
        $encryptLocation = storage_path().'/app/public/app/js';
        $realLocation = resource_path().'/js/temp/'.strval($type_id);
        File::move($encryptLocation.'/'.$filename, $realLocation.'/'.$filename);

        File::delete($tempLocation.'/'.$filename);
        File::delete($encryptLocation.'/'.$filename);

        $resource = new AppResources();
        $resource->app_id = $app_id;
        $resource->type_id = $type_id;
        $resource->save();

        // $content = File::get($realLocation.'/'.$filename);
        // $decript = openssl_decrypt($content, 'des-ede3-cbc', $DES3_KEY, OPENSSL_RAW_DATA, $DES3_IV);

        // return response()->json(['decrypted'=>$decript]);

        return redirect('/resources'.'/'.$type_id);
    }

    public function updateResource(Request $request) {
        $res_id = $request->resource_id;
        $file  = $request->file('file');

        $cond = AppResources::where('id', $res_id);
        $resource = $cond->first();

        if ($resource == null) {
            return response()->json(['success'=>false, 'message'=>'Cannot find a resource. Please create new one.']);
        }

        $app_id = $resource->app_id;
        $type_id  = $resource->type_id;
        // Save File To Public Storage
        $tempLocation = storage_path().'/'.'app/public/temp';
        $file->storeAs('public/temp', $app_id);

        // Get File and Encrypt Content
        $content = File::get($tempLocation.'/'.$app_id);

        $DES3_KEY = env('XCS_SECRET', 'LbGqH750ukm7g2fbWqzDbQ5L');
        $DES3_IV = env('XCS_IV', 'jefQJhKG');

        $encrypt = openssl_encrypt($content, "des-ede3-cbc", $DES3_KEY, OPENSSL_RAW_DATA, $DES3_IV);
        
        // Save Encrypted File To Public Storage
        Storage::put('public/app/js/'.$app_id, $encrypt);

        // Move File To Resource From Public
        $encryptLocation = storage_path().'/app/public/app/js';
        $realLocation = resource_path().'/js/temp/'.strval($type_id);
        File::move($encryptLocation.'/'.$app_id, $realLocation.'/'.$app_id);

        File::delete($tempLocation.'/'.$app_id);
        File::delete($encryptLocation.'/'.$app_id);

        $resource->touch();

        return redirect('/resources'.'/'.$type_id);
    }

    public function uploadChangbaoResource(Request $request) {
        $app_id   = $request->app_list;
        $type_id  = $request->type_id;

        $filename = $app_id;

        $file = $request->file('file');

        // Save File To Public Storage
        $tempLocation = storage_path().'/'.'app/public/temp';
        $file->storeAs('public/temp', $filename);

        // Get File and Encrypt Content
        $content = File::get($tempLocation.'/'.$filename);

        $DES3_KEY = env('XCS_SECRET', 'LbGqH750ukm7g2fbWqzDbQ5L');
        $DES3_IV = env('XCS_IV', 'jefQJhKG');

        $encrypt = openssl_encrypt($content, "des-ede3-cbc", $DES3_KEY, OPENSSL_RAW_DATA, $DES3_IV);
        
        // Save Encrypted File To Public Storage
        Storage::put('public/app/js/'.$filename, $encrypt);

        // Move File To Resource From Public
        $encryptLocation = storage_path().'/app/public/app/js';
        $realLocation = resource_path().'/js/changbao/'.strval($type_id);
        File::move($encryptLocation.'/'.$filename, $realLocation.'/'.$filename);

        File::delete($tempLocation.'/'.$filename);
        File::delete($encryptLocation.'/'.$filename);

        return redirect('/resources'.'/'.$type_id);
    }

    public function uploadMileResource(Request $request) {
        $filename = $request->file_name;
        $type_id  = $request->type_id;

        $file  = $request->file('file');

        // Save File To Public Storage
        $tempLocation = storage_path().'/'.'app/public/temp';
        $file->storeAs('public/temp', $filename);

        // Get File and Encrypt Content
        $content = File::get($tempLocation.'/'.$filename);

        $DES3_KEY = env('XCS_SECRET', 'LbGqH750ukm7g2fbWqzDbQ5L');
        $DES3_IV = env('XCS_IV', 'jefQJhKG');

        $encrypt = openssl_encrypt($content, "des-ede3-cbc", $DES3_KEY, OPENSSL_RAW_DATA, $DES3_IV);
        
        // Save Encrypted File To Public Storage
        Storage::put('public/app/js/'.$filename, $encrypt);

        // Move File To Resource From Public
        $encryptLocation = storage_path().'/app/public/app/js';
        $realLocation = resource_path().'/js/mile/'.strval($type_id);

        if (!File::isDirectory($realLocation)) {
            File::makeDirectory($realLocation);
        }

        File::move($encryptLocation.'/'.$filename, $realLocation.'/'.$filename);

        File::delete($tempLocation.'/'.$filename);
        File::delete($encryptLocation.'/'.$filename);

        return redirect('/resources'.'/'.$type_id);
    }
}
