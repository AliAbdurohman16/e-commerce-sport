<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        // find setting data by id 1
        $setting = Setting::find(1);

        return view('backend.setting.index', compact('setting'));
    }

    public function store(Request $request)
    {
        // find setting data by id 1
        $setting = Setting::find(1);

        // validation
        $request->validate([
            'photo_slider' => 'mimes:jpg,png,jpeg|image|max:2048',
            'title_slider' => 'required',
            'desc_slider' => 'required',
            'name_bank' => 'required',
            'no_rek' => 'required',
            'about_footer' => 'required',
        ]);

        // checking photo slider
        if ($request->hasFile('photo_slider')) {
            $photoSlider1Path = $request->file('photo_slider')->store('public/settings');

            if ($setting->photo_slider != 'default/image.png') {
                Storage::delete('public/settings/' . $setting->photo_slider);
            }

            $photoSliderName = basename($photoSlider1Path);
        } else {
            $photoSliderName = $setting->photo_slider;
        }

        // update to database
        $setting->update([
            'photo_slider' => $photoSliderName,
            'title_slider' => $request->title_slider,
            'desc_slider' => $request->desc_slider,
            'name_bank' => $request->name_bank,
            'no_rek' => $request->no_rek,
            'about_footer' => $request->about_footer,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
        ]);

        return redirect()->back()->with('message', 'Data berhasil diubah!');
    }
}
