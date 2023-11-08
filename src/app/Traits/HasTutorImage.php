<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasTutorImage
{
    /**
     * Update the tutor image.
     *
     * @param  string  $storagePath
     * @return void
     */
    public function updateTutorImage(UploadedFile $photo, $storagePath = 'tutor-images')
    {
        tap($this->photo, function ($previous) use ($photo, $storagePath) {
            $this->forceFill([
                'image' => $photo->storePublicly(
                    $storagePath, ['disk' => $this->WebinarTutorImageDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->WebinarTutorImageDisk())->delete($previous);
            }
        });
    }

    /**
     * Delete the tutor image.
     *
     * @return void
     */
    public function deleteTutorImage()
    {

        if (is_null($this->image)) {
            return;
        }

        Storage::disk($this->WebinarTutorImageDisk())->delete($this->image);

        $this->forceFill([
            'image' => null,
        ])->save();
    }

    /**
     * Get the URL to the tutor image.
     */
    public function TutorImageUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->image
                    ? Storage::disk($this->WebinarTutorImageDisk())->url($this->image)
                    : '';
        });
    }

    /**
     * Get the disk that profile photos should be stored on.
     *
     * @return string
     */
    protected function WebinarTutorImageDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : 'public';
    }
}
