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
            'name' => 'required',
            'logo' => 'mimes:jpg,png,jpeg|image|max:2048',
            'favicon' => 'mimes:jpg,png,jpeg,ico|max:2048',
            'photo_slider_1' => 'mimes:jpg,png,jpeg|image|max:2048',
            'photo_slider_2' => 'mimes:jpg,png,jpeg|image|max:2048',
            'photo_slider_3' => 'mimes:jpg,png,jpeg|image|max:2048',
            'title_slider_1' => 'required',
            'title_slider_2' => 'required',
            'title_slider_3' => 'required',
            'desc_slider_1' => 'required',
            'desc_slider_2' => 'required',
            'desc_slider_3' => 'required',
            'advertisement_1' => 'mimes:jpg,png,jpeg|image|max:2048',
            'advertisement_2' => 'mimes:jpg,png,jpeg|image|max:2048',
            'advertisement_3' => 'mimes:jpg,png,jpeg|image|max:2048',
            'photo_cta' => 'mimes:jpg,png,jpeg|image|max:2048',
            'title_cta' => 'required',
            'desc_cta' => 'required',
            'about_footer' => 'required',
        ]);

        // checking logo
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('public/settings');

            if ($setting->logo != 'default/image.png') {
                Storage::delete('public/settings/' . $setting->logo);
            }

            $logoName = basename($logoPath);
        } else {
            $logoName = $setting->logo;
        }

        // checking favicon
        if ($request->hasFile('favicon')) {
            $faviconPath = $request->file('favicon')->store('public/settings');

            if ($setting->favicon != 'default/image.png') {
                Storage::delete('public/settings/' . $setting->favicon);
            }

            $faviconName = basename($faviconPath);
        } else {
            $faviconName = $setting->favicon;
        }

        // checking photo slider 1
        if ($request->hasFile('photo_slider_1')) {
            $photoSlider1Path = $request->file('photo_slider_1')->store('public/settings');

            if ($setting->photo_slider_1 != 'default/image.png') {
                Storage::delete('public/settings/' . $setting->photo_slider_1);
            }

            $photoSlider1Name = basename($photoSlider1Path);
        } else {
            $photoSlider1Name = $setting->photo_slider_1;
        }

        // checking photo slider 2
        if ($request->hasFile('photo_slider_2')) {
            $photoSlider2Path = $request->file('photo_slider_2')->store('public/settings');

            if ($setting->photo_slider_2 != 'default/image.png') {
                Storage::delete('public/settings/' . $setting->photo_slider_2);
            }

            $photoSlider2Name = basename($photoSlider2Path);
        } else {
            $photoSlider2Name = $setting->photo_slider_2;
        }

        // checking photo slider 3
        if ($request->hasFile('photo_slider_3')) {
            $photoSlider3Path = $request->file('photo_slider_3')->store('public/settings');

            if ($setting->photo_slider_3 != 'default/image.png') {
                Storage::delete('public/settings/' . $setting->photo_slider_3);
            }

            $photoSlider3Name = basename($photoSlider3Path);
        } else {
            $photoSlider3Name = $setting->photo_slider_3;
        }

        // checking advertisement 1
        if ($request->hasFile('advertisement_1')) {
            $advertisement1Path = $request->file('advertisement_1')->store('public/settings');

            if ($setting->advertisement_1 != 'default/image.png') {
                Storage::delete('public/settings/' . $setting->advertisement_1);
            }

            $advertisement1Name = basename($advertisement1Path);
        } else {
            $advertisement1Name = $setting->advertisement_1;
        }

        // checking advertisement 2
        if ($request->hasFile('advertisement_2')) {
            $advertisement2Path = $request->file('advertisement_2')->store('public/settings');

            if ($setting->advertisement_2 != 'default/image.png') {
                Storage::delete('public/settings/' . $setting->advertisement_2);
            }

            $advertisement2Name = basename($advertisement2Path);
        } else {
            $advertisement2Name = $setting->advertisement_2;
        }

        // checking advertisement 3
        if ($request->hasFile('advertisement_3')) {
            $advertisement3Path = $request->file('advertisement_3')->store('public/settings');

            if ($setting->advertisement_3 != 'default/image.png') {
                Storage::delete('public/settings/' . $setting->advertisement_3);
            }

            $advertisement3Name = basename($advertisement3Path);
        } else {
            $advertisement3Name = $setting->advertisement_3;
        }

        // checking photo cta
        if ($request->hasFile('photo_cta')) {
            $photoCtaPath = $request->file('photo_cta')->store('public/settings');

            if ($setting->photo_cta != 'default/image.png') {
                Storage::delete('public/settings/' . $setting->photo_cta);
            }

            $photoCtaName = basename($photoCtaPath);
        } else {
            $photoCtaName = $setting->photo_cta;
        }

        // update to database
        $setting->update([
            'name' => $request->name,
            'logo' => $logoName,
            'favicon' => $faviconName,
            'photo_slider_1' => $photoSlider1Name,
            'photo_slider_2' => $photoSlider2Name,
            'photo_slider_3' => $photoSlider3Name,
            'title_slider_1' => $request->title_slider_1,
            'title_slider_2' => $request->title_slider_2,
            'title_slider_3' => $request->title_slider_3,
            'desc_slider_1' => $request->desc_slider_1,
            'desc_slider_2' => $request->desc_slider_2,
            'desc_slider_3' => $request->desc_slider_3,
            'advertisement_1' => $advertisement1Name,
            'advertisement_2' => $advertisement2Name,
            'advertisement_3' => $advertisement3Name,
            'photo_cta' => $photoCtaName,
            'title_cta' => $request->title_cta,
            'desc_cta' => $request->desc_cta,
            'about_footer' => $request->about_footer,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
        ]);

        return redirect()->back()->with('message', 'Data berhasil diubah!');
    }
}
