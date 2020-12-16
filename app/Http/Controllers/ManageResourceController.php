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
            $data['name'] = $resource->name;
            $data['size'] = $resource->size;
            $data['created_at'] = $resource->created_at;

            array_push($deviceList, $data);
        }

        return view('resources', array('resources' => $deviceList));
    }

    public function uploadResource(Request $request)
    {
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();

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
        $realLocation = resource_path().'/js/temp';
        File::move($encryptLocation.'/'.$filename, $realLocation.'/'.$filename);

        File::delete($tempLocation.'/'.$filename);
        File::delete($encryptLocation.'/'.$filename);

        $resource = new Resource();
        $resource->name = $filename;
        $resource->size = $file->getSize();
        $resource->save();

        // $content = File::get($realLocation.'/'.$filename);
        // $decript = openssl_decrypt($content, 'des-ede3-cbc', $DES3_KEY, OPENSSL_RAW_DATA, $DES3_IV);

        // return response()->json(['decrypted'=>$decript]);

        return redirect('/resources');
    }

    public function updateResource(Request $request) {
        $res_id = $request->resource_id;
        $file  = $request->file('file');
        $filename = $file->getClientOriginalName();

        $cond = Resource::where('id', $res_id);
        $resource = $cond->first();

        if ($resource == null) {
            return response()->json(['success'=>false, 'message'=>'Cannot find a resource. Please create new one.']);
        }

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
        $realLocation = resource_path().'/js/temp';
        File::move($encryptLocation.'/'.$filename, $realLocation.'/'.$filename);

        File::delete($tempLocation.'/'.$filename);
        File::delete($encryptLocation.'/'.$filename);

        $resource->name = $filename;
        $resource->size = $file->getSize();
        $resource->save();
        $resource->touch();

        return redirect('/resources');
    }
}
