<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasWebinarRecordingThumbnail
{
    /**
     * Update the recording thumbnail.
     *
     * @param  \Illuminate\Http\UploadedFile  $photo
     * @param  string  $storagePath
     * @return void
     */
    public function updateRecordingThumbnail(UploadedFile $photo, $storagePath = 'recording-thumbnails')
    {
        tap($this->thumbnail, function ($previous) use ($photo, $storagePath) {
            $this->forceFill([
                'thumbnail' => $photo->storePublicly(
                    $storagePath, ['disk' => $this->RecordingThumbnailDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->RecordingThumbnailDisk())->delete($previous);
            }
        });
    }

    /**
     * Delete the recording thumbnail.
     *
     * @return void
     */
    public function deleteRecordingThumbnail()
    {

        if (is_null($this->thumbnail)) {
            return;
        }

        Storage::disk($this->RecordingThumbnailDisk())->delete($this->thumbnail);

        $this->forceFill([
            'thumbnail' => null,
        ])->save();
    }

    /**
     * Get the URL to the recording thumbnail.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function RecordingThumbnailUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->thumbnail
                    ? Storage::disk($this->RecordingThumbnailDisk())->url($this->thumbnail)
                    : '';
        });
    }

    /**
     * Get the disk that profile photos should be stored on.
     *
     * @return string
     */
    protected function RecordingThumbnailDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : 'public';
    }
}
