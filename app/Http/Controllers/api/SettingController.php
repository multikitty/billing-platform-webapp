<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\PracticeSetting;
use App\Utils\SettingUtil;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    /**
     * setting utility
     */
    protected SettingUtil $settingUtil;

    // local setting variable
    protected ?PracticeSetting $practice_setting;

    public function __construct(SettingUtil $settingUtil)
    {
        $this->settingUtil = $settingUtil;
    }

    // Internal logic
    /**
     * Get current user's practice setting or create new one.
     */
    private function setSettingOrCreateNewOne()
    {
        // Get current user's setting
        $this->practice_setting = auth()->user()->practice_setting;

        // Create new setting if null
        if($this->practice_setting == null) {
            $this->practice_setting = new PracticeSetting();
            $this->practice_setting->team_id = auth()->user()->team_id;
            $this->practice_setting->save();
        }
    }

    //
    /**
     * Get current user's setting
     */
    public function indexPracticeSetting(Request $request)
    {
        $this->setSettingOrCreateNewOne();

        return new JsonResponse($this->practice_setting);
    }

    /**
     * Save practice setting
     */
    public function savePracticeSetting(Request $request)
    {
        $all = $request->all();
        $this->setSettingOrCreateNewOne();

        $this->practice_setting->update($all);

        foreach($all['practice_additional_setting'] as $_additionalSetting) {
            try {
                $this->practice_setting->practice_additional_setting()->findOrFail($_additionalSetting['id'])->update($_additionalSetting);
            } catch (Exception $e) {

            }
        }

        return response()->json();
    }

    /**
     * Update practice setting logo
     */
    public function updatePracticeSettingLogo(Request $request)
    {
        $this->setSettingOrCreateNewOne();

        if($this->settingUtil->updateLogo($this->practice_setting, $request))
        {
            $this->practice_setting->refresh();
        }

        return response()->json($this->practice_setting);
    }

    /**
     * Create new additional setting.
     * @param Request $request
     */
    public function createPracticeAdditionalSetting(Request $request)
    {
        $rule = [
            'title' => 'required'
        ];

        $validator = Validator::make($request->all(), $rule);

        if($validator->fails()) {
            return response()->json($request->all(), 422);
        }

        $this->setSettingOrCreateNewOne();

        $all = $request->all();

        $newAdditionalSetting = $this->practice_setting->practice_additional_setting()->create($all);

        return response()->json($newAdditionalSetting);
    }

    public function deletePracticeAdditionalSetting(Request $request, int $id)
    {
        $this->setSettingOrCreateNewOne();

        try {
            $this->practice_setting->practice_additional_setting()->findOrFail($id)->delete();
        } catch(Exception $e) {

        }

        return response()->json();
    }
}
