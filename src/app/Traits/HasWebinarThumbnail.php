<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasWebinarThumbnail
{
    /**
     * Update the webinar thumbnail.
     *
     * @param  \Illuminate\Http\UploadedFile  $photo
     * @param  string  $storagePath
     * @return void
     */
    public function updateWebinarThumbnail(UploadedFile $photo, $storagePath = 'webinar-tumbnails')
    {
        tap($this->feature_image, function ($previous) use ($photo, $storagePath) {
            $this->forceFill([
                'feature_image' => $photo->storePublicly(
                    $storagePath, ['disk' => $this->WebinarThumbnailDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->WebinarThumbnailDisk())->delete($previous);
            }
        });
    }

    /**
     * Delete the webinar thumbnail.
     *
     * @return void
     */
    public function deleteWebinarThumbnail()
    {

        if (is_null($this->feature_image)) {
            return;
        }

        Storage::disk($this->WebinarThumbnailDisk())->delete($this->feature_image);

        $this->forceFill([
            'feature_image' => null,
        ])->save();
    }

    /**
     * Get the URL to the webinar thumbnail.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function WebinarThumbnailUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->feature_image
                    ? Storage::disk($this->WebinarThumbnailDisk())->url($this->feature_image)
                    : '';
        });
    }

    /**
     * Get the disk that profile photos should be stored on.
     *
     * @return string
     */
    protected function WebinarThumbnailDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : 'public';
    }
}
