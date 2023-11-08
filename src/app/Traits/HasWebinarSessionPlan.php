<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasWebinarSessionPlan
{
    /**
     * Update the webinar brochure.
     *
     * @param  string  $storagePath
     * @return void
     */
    public function updateWebinarSessionPlan(UploadedFile $photo, $storagePath = 'session-plan-pdfs')
    {
        tap($this->session_plan_pdf, function ($previous) use ($photo, $storagePath) {
            $this->forceFill([
                'session_plan_pdf' => $photo->storePublicly(
                    $storagePath, ['disk' => $this->WebinarSessionPlanDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->WebinarSessionPlanDisk())->delete($previous);
            }
        });
    }

    /**
     * Delete the webinar brochure.
     *
     * @return void
     */
    public function deleteWebinarSessionPlan()
    {

        if (is_null($this->session_plan_pdf)) {
            return;
        }

        Storage::disk($this->WebinarSessionPlanDisk())->delete($this->session_plan_pdf);

        $this->forceFill([
            'session_plan_pdf' => null,
        ])->save();
    }

    /**
     * Get the URL to the webinar brochure.
     */
    public function WebinarSessionPlanUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->session_plan_pdf
                    ? Storage::disk($this->WebinarSessionPlanDisk())->url($this->session_plan_pdf)
                    : '';
        });
    }

    /**
     * Get the disk that profile photos should be stored on.
     *
     * @return string
     */
    protected function WebinarSessionPlanDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : 'public';
    }
}
