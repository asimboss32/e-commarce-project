<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\policy;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class settingsController extends Controller
{
    public function showSettings()
    {
        $generalSettings = SiteSetting::first();
        return view('Backend.settings.general-settings',compact('generalSettings'));
    }
    public function updateSettings(Request $request)
    {
        $generalSettings = SiteSetting::first();

        $generalSettings->phone = $request->phone;
        $generalSettings->email = $request->email;
        $generalSettings->address = $request->address;
        $generalSettings->facebook = $request->facebook;
        $generalSettings->twitter = $request->twitter;
        $generalSettings->instagram = $request->instagram;
        $generalSettings->youtube = $request->youtube;

        if (isset($request->logo)){
            if ($generalSettings->logo && file_exists('backend/images/setting/'.$generalSettings->logo)) {
                unlink('backend/images/setting/'.$generalSettings->logo);
            }

            $imageName = rand() . "-logo." . $request->logo->extension();
            $request->logo->move('backend/images/setting', $imageName);
            $generalSettings->logo = $imageName;
        }
          if (isset($request->banner)){
            if ($generalSettings->banner && file_exists('backend/images/setting/'.$generalSettings->banner)) {
                unlink('backend/images/setting/'.$generalSettings->banner);
            }

            $imageName = rand() . "-banner." . $request->banner->extension();
            $request->banner->move('backend/images/setting', $imageName);
            $generalSettings->banner = $imageName;

            $generalSettings->save();
            return redirect()->back();
        }
    }
    public function showPolicyProcess()
    {
        $policy = policy::first();
        return view('Backend.settings.policy-process',compact('policy'));
    }
    public function updatePolicyProcess(Request $request)
    {
        $policy = policy::first();

        $policy->privacy_policy = 	$request->privacy_policy;
        $policy->terms_conditions = $request->terms_conditions;
        $policy->refund_policy = 	$request->refund_policy;
        $policy->payment_policy = 	$request->payment_policy;
        $policy->about_us = $request->about_us;
        $policy->return_process = $request->return_process;
             

        $policy->save();
        return redirect()->back();

    }
}
