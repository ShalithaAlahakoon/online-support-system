<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasReviewVideo
{
    /**
     * Update the key feature image.
     *
     * @param  \Illuminate\Http\UploadedFile  $video
     * @param string $storagePath
     * @return void
     */
    public function updateReviewVideo (UploadedFile $video, string $storagePath = 'reviews-videos'): void
    {
        tap($this->video, function ($previous) use ($video, $storagePath) {

            $this->forceFill([
                'video' => $video->storePublicly(
                    $storagePath, ['disk' => $this->reviewVideoDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->reviewVideoDisk())->delete($previous);
            }
        });

    }

    /**
     * Delete the key feature video.
     *
     * @return void
     */
    public function deleteReviewVideo(): void
    {

        if (is_null($this->video)) {
            return;
        }

        Storage::disk($this->reviewVideoDisk())->delete($this->video);

        $this->forceFill([
            'video' => null,
        ])->save();
    }

    /**
     * Get the URL to the key feature video.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function reviewVideoUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->video
                ? Storage::disk($this->reviewVideoDisk())->url($this->video)
                : '';
        });
    }

    /**
     * Get the disk that videos should be stored on.
     *
     * @return string
     */
    protected function reviewVideoDisk(): string
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : 'public';
    }
}
