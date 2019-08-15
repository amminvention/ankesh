<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:settings');
    }

    public function create()
    {
        $setting = Setting::latest()->first();
        return view('setting.setting', compact('setting'));
    }

    public function store(Request $request)
    {
        $validatedData= $this->validate($request, [
            'site_name' => 'nullable',
            'mail_driver' => 'nullable',
            'mail_host' => 'nullable',
            'mail_port' => 'nullable',
            'mail_username' => 'nullable',
            'mail_password' => 'nullable',
            'mail_from' => 'nullable',
        ]);

        if($request->hasFile('site_logo')){

            $this->validate($request,[
                'site_logo' => 'nullable|mimes:png,jpg,jpeg,svg|max:2048'
            ]);

            $image = $request['site_logo'];
            $fileName = time() . $image->getClientOriginalName();
            $image->move('images/', $fileName);
            $image = 'images/' . $fileName;
            $validatedData['site_logo'] = $image;
        }

        if($request->hasFile('site_fav')){

            $this->validate($request,[
                'site_fav' => 'nullable|mimes:png,jpg,jpeg,svg|max:2048'
            ]);

            $image = $request['site_fav'];
            $fileName = time() . $image->getClientOriginalName();
            $image->move('images/', $fileName);
            $image = 'images/' . $fileName;
            $validatedData['site_fav'] = $image;
        }

        $setting = Setting::latest()->first();


        if($setting == null){
            Setting::create($validatedData);
            return back()->with('success','Settings saved successfully');
        }else{
            if($request->hasFile('site_logo')){
                $prev_img = $setting->site_logo;
                if (File::exists($prev_img)) { // unlink or remove previous image from folder
                    unlink($prev_img);
                }
            }

            if($request->hasFile('site_fav')){
                $prev_img_2 = $setting->site_fav;
                if (File::exists($prev_img_2)) { // unlink or remove previous image from folder
                    unlink($prev_img_2);
                }
            }
            $setting->update($validatedData);
            return back()->with('success','Settings saved successfully');
        }
    }

}
