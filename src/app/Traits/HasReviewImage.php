<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasReviewImage
{
    /**
     * Update the key feature image.
     *
     * @param  \Illuminate\Http\UploadedFile  $photo
     * @param string $storagePath
     * @return void
     */
    public function updateReviewImage (UploadedFile $photo, string $storagePath = 'reviews-images'): void
    {
        tap($this->image, function ($previous) use ($photo, $storagePath) {

            $this->forceFill([
                'image' => $photo->storePublicly(
                    $storagePath, ['disk' => $this->reviewImageDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->reviewImageDisk())->delete($previous);
            }
        });

    }

    /**
     * Delete the key feature image.
     *
     * @return void
     */
    public function deleteReviewImage()
    {

        if (is_null($this->image)) {
            return;
        }

        Storage::disk($this->reviewImageDisk())->delete($this->image);

        $this->forceFill([
            'image' => null,
        ])->save();
    }

    /**
     * Get the URL to the key feature image.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function reviewImageUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->image
                ? Storage::disk($this->reviewImageDisk())->url($this->image)
                : '';
        });
    }

    /**
     * Get the disk that profile photos should be stored on.
     *
     * @return string
     */
    protected function reviewImageDisk(): string
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : 'public';
    }
}
