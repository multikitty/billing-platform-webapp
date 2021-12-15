<?php

namespace App\Utils;

use App\Models\PracticeSetting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class SettingUtil {
    protected $practiceSettingLogoStorage;

    public function __construct()
    {
        $this->practiceSettingLogoStorage = Storage::disk('setting_logo');
    }

    public function updateLogo(PracticeSetting $setting, Request $request): bool
    {
        // if request include new logo file
        if($request->file('practice_logo')) {
            // remove old logo if exist
            if($this->practiceSettingLogoStorage->exists($setting->practice_logo)) {
                $this->practiceSettingLogoStorage->delete($setting->practice_logo);
            }

            $newPath = $this->practiceSettingLogoStorage->put('', $request->file('practice_logo'));

            $setting->practice_logo = $newPath;

            $setting->save();

            return true;
        }

        return false;
    }
}
