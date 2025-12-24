<?php

namespace App\Http\Controllers;

use App\Models\FuzzySetting;
use Illuminate\Http\Request;

class FuzzySettingController extends Controller
{
    public function edit()
    {
        $setting = FuzzySetting::first();
        return view('fuzzy.setting', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = FuzzySetting::first();

        $setting->update($request->all());

        return back()->with('success','Nilai fuzzy diperbarui');
    }
}
