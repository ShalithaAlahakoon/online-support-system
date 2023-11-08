<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasAwardingBodyPhoto
{
    /**
     * Update the awarding body photo.
     *
     * @param  \Illuminate\Http\UploadedFile  $photo
     * @param  string  $storagePath
     * @return void
     */
    public function updateAwardingBodyPhoto(UploadedFile $photo, $storagePath = 'awarding-body-photos')
    {
        tap($this->awarding_body_photo_path, function ($previous) use ($photo, $storagePath) {
            $this->forceFill([
                'awarding_body_photo_path' => $photo->storePublicly(
                    $storagePath, ['disk' => $this->awardingBodyPhotoDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->awardingBodyPhotoDisk())->delete($previous);
            }
        });
    }

    /**
     * Delete awarding body photo.
     *
     * @return void
     */
    public function deleteAwardingBodyPhoto()
    {

        if (is_null($this->awarding_body_photo_path)) {
            return;
        }

        Storage::disk($this->awardingBodyPhotoDisk())->delete($this->awarding_body_photo_path);

        $this->forceFill([
            'awarding-body-photos' => null,
        ])->save();
    }

    /**
     * Get the URL to the awarding body photo.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function awardingBodyPhotoUrl(): Attribute
    {

        return Attribute::get(function () {
            return $this->awarding_body_photo_path
                ? Storage::disk($this->awardingBodyPhotoDisk())->url($this->awarding_body_photo_path)
                : '';
        });
    }



    /**
     * Get the disk that awarding body photos should be stored on.
     *
     * @return string
     */
    protected function awardingBodyPhotoDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : 'public';
    }
}
