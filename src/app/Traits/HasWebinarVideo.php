<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasWebinarVideo
{
    /**
     * Update the webinar video.
     *
     * @param  \Illuminate\Http\UploadedFile  $photo
     * @param  string  $storagePath
     * @return void
     */
    public function updateWebinarVideo(UploadedFile $photo, $storagePath = 'webinar-feature-videos')
    {
        tap($this->feature_video, function ($previous) use ($photo, $storagePath) {
            $this->forceFill([
                'feature_video' => $photo->storePublicly(
                    $storagePath, ['disk' => $this->WebinarVideoDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->WebinarVideoDisk())->delete($previous);
            }
        });
    }

    /**
     * Delete the webinar video.
     *
     * @return void
     */
    public function deleteWebinarVideo()
    {

        if (is_null($this->feature_video)) {
            return;
        }

        Storage::disk($this->WebinarVideoDisk())->delete($this->feature_video);

        $this->forceFill([
            'feature_video' => null,
        ])->save();
    }

    /**
     * Get the URL to the webinar video.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function WebinarVideoUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->feature_video
                    ? Storage::disk($this->WebinarVideoDisk())->url($this->feature_video)
                    : '';
        });
    }

    /**
     * Get the disk that profile photos should be stored on.
     *
     * @return string
     */
    protected function WebinarVideoDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : 'public';
    }
}
