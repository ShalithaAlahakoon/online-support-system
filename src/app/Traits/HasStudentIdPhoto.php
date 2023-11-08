<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasStudentIdPhoto
{
    /**
     * Update the user's ID card photo.
     *
     * @param  string  $storagePath
     * @return void
     */
    public function updateIdCardPhoto(UploadedFile $photo, $storagePath = 'id-photos')
    {
        tap($this->image, function ($previous) use ($photo, $storagePath) {
            $this->forceFill([
                'image' => $photo->storePublicly(
                    $storagePath, ['disk' => $this->idCardImageDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->idCardImageDisk())->delete($previous);
            }
        });
    }

    /**
     * Delete the user's ID card photo.
     *
     * @return void
     */
    public function deleteIdCardPhoto()
    {
        if (is_null($this->image)) {
            return;
        }

        Storage::disk($this->idCardImageDisk())->delete($this->image);

        $this->forceFill([
            'image' => null,
        ])->save();
    }

    /**
     * Get the URL to the user's ID card photo.
     */
    public function idCardPhotoUrl(): Attribute
    {

        return Attribute::get(function () {
            return $this->image
                ? Storage::disk($this->idCardImageDisk())->url($this->image)
                : $this->defaultIdCardPhotoUrl();
        });
    }

    /**
     * Get the default ID card photo URL if no photo has been uploaded.
     *
     * @return string
     */
    protected function defaultIdCardPhotoUrl()
    {
        $name = trim(collect(explode(' ', $this->fullname))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
    }

    /**
     * Get the disk that ID card photos should be stored on.
     *
     * @return string
     */
    protected function idCardImageDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('jetstream.profile_photo_disk', 'public');
    }
}
