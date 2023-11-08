<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasKeyFeatureIcon
{
    /**
     * Update the key feature icon.
     *
     * @param  string  $storagePath
     * @return void
     */
    public function updateKeyFeatureIcon(UploadedFile $photo, $storagePath = 'keyfeature-icons')
    {
        tap($this->icon, function ($previous) use ($photo, $storagePath) {
            $this->forceFill([
                'icon' => $photo->storePublicly(
                    $storagePath, ['disk' => $this->KeyFeatureIconDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->KeyFeatureIconDisk())->delete($previous);
            }
        });
    }

    /**
     * Delete the key feature icon.
     *
     * @return void
     */
    public function deleteKeyFeatureIcon()
    {

        if (is_null($this->icon)) {
            return;
        }

        Storage::disk($this->KeyFeatureIconDisk())->delete($this->icon);

        $this->forceFill([
            'icon' => null,
        ])->save();
    }

    /**
     * Get the URL to the key feature icon.
     */
    public function KeyFeatureIconUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->icon
                    ? Storage::disk($this->KeyFeatureIconDisk())->url($this->icon)
                    : '';
        });
    }

    /**
     * Get the disk that profile photos should be stored on.
     *
     * @return string
     */
    protected function KeyFeatureIconDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : 'public';
    }
}
