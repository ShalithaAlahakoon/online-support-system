<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasWebinarRecordingVideo
{
    /**
     * Update the webinar recorded video.
     *
     * @param  \Illuminate\Http\UploadedFile  $photo
     * @param  string  $storagePath
     * @return void
     */
    public function updateWebinarRecordingVideo(UploadedFile $photo, $storagePath = 'webinar-recorded-videos')
    {
        tap($this->video_link, function ($previous) use ($photo, $storagePath) {
            $this->forceFill([
                'video_link' => $photo->storePublicly(
                    $storagePath, ['disk' => $this->WebinarRecordingVideoDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->WebinarRecordingVideoDisk())->delete($previous);
            }
        });
    }

    /**
     * Delete the webinar recorded video.
     *
     * @return void
     */
    public function deleteWebinarRecordingVideo()
    {

        if (is_null($this->video_link)) {
            return;
        }

        Storage::disk($this->WebinarRecordingVideoDisk())->delete($this->video_link);

        $this->forceFill([
            'video_link' => null,
        ])->save();
    }

    /**
     * Get the URL to the webinar recorded video.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function WebinarRecordingVideoUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->video_link
                    ? Storage::disk($this->WebinarRecordingVideoDisk())->url($this->video_link)
                    : '';
        });
    }

    /**
     * Get the disk that profile photos should be stored on.
     *
     * @return string
     */
    protected function WebinarRecordingVideoDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : 'public';
    }
}
