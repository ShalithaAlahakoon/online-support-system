<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasWebinarBrochure
{
    /**
     * Update the webinar brochure.
     *
     * @param  string  $storagePath
     * @return void
     */
    public function updateWebinarBrochure(UploadedFile $photo, $storagePath = 'webinar-brocures')
    {
        tap($this->webinar_broacher, function ($previous) use ($photo, $storagePath) {
            $this->forceFill([
                'webinar_broacher' => $photo->storePublicly(
                    $storagePath, ['disk' => $this->WebinarBrochureDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->WebinarBrochureDisk())->delete($previous);
            }
        });
    }

    /**
     * Delete the webinar brochure.
     *
     * @return void
     */
    public function deleteWebinarBrochure()
    {

        if (is_null($this->webinar_broacher)) {
            return;
        }

        Storage::disk($this->WebinarBrochureDisk())->delete($this->webinar_broacher);

        $this->forceFill([
            'webinar_broacher' => null,
        ])->save();
    }

    /**
     * Get the URL to the webinar brochure.
     */
    public function WebinarBrochureUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->webinar_broacher
                    ? Storage::disk($this->WebinarBrochureDisk())->url($this->webinar_broacher)
                    : '';
        });
    }

    /**
     * Get the disk that profile photos should be stored on.
     *
     * @return string
     */
    protected function WebinarBrochureDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : 'public';
    }
}
