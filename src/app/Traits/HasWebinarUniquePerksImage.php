<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasWebinarUniquePerksImage
{
    /**
     * Update the webinar UniquePerksImage.
     *
     * @param  \Illuminate\Http\UploadedFile  $photo
     * @param  string  $storagePath
     * @return void
     */
    public function updateWebinarUniquePerksImage(UploadedFile $photo, $storagePath = 'webinar-uniquePerks-images')
    {
        tap($this->unique_perks_image, function ($previous) use ($photo, $storagePath) {
            $this->forceFill([
                'unique_perks_image' => $photo->storePublicly(
                    $storagePath, ['disk' => $this->WebinarUniquePerksImageDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->WebinarUniquePerksImageDisk())->delete($previous);
            }
        });
    }

    /**
     * Delete the webinar UniquePerksImage.
     *
     * @return void
     */
    public function deleteWebinarUniquePerksImage()
    {

        if (is_null($this->unique_perks_image)) {
            return;
        }

        Storage::disk($this->WebinarUniquePerksImageDisk())->delete($this->unique_perks_image);

        $this->forceFill([
            'unique_perks_image' => null,
        ])->save();
    }

    /**
     * Get the URL to the webinar UniquePerksImage.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function WebinarUniquePerksImageUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->unique_perks_image
                    ? Storage::disk($this->WebinarUniquePerksImageDisk())->url($this->unique_perks_image)
                    : '';
        });
    }

    /**
     * Get the disk that profile photos should be stored on.
     *
     * @return string
     */
    protected function WebinarUniquePerksImageDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('jetstream.profile_photo_disk', 'public');
    }
}
