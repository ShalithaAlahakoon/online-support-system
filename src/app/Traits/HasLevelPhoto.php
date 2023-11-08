<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasLevelPhoto
{
    /**
     * Update the level photo.
     *
     * @param  string  $storagePath
     * @return void
     */
    public function updateLevelPhoto(UploadedFile $photo, $storagePath = 'level-photos')
    {
        tap($this->level_photo_path, function ($previous) use ($photo, $storagePath) {
            $this->forceFill([
                'level_photo_path' => $photo->storePublicly(
                    $storagePath, ['disk' => $this->levelPhotoDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->levelPhotoDisk())->delete($previous);
            }
        });
    }

    /**
     * Delete level photo.
     *
     * @return void
     */
    public function deleteLevelPhoto()
    {

        if (is_null($this->level_photo_path)) {
            return;
        }

        Storage::disk($this->levelPhotoDisk())->delete($this->level_photo_path);

        $this->forceFill([
            'level_photo_path' => null,
        ])->save();
    }

    /**
     * Get the URL to the level photo.
     */
    public function levelPhotoUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->level_photo_path
                ? Storage::disk($this->levelPhotoDisk())->url($this->level_photo_path)
                : '';
        });
    }

    /**
     * Get the disk that level photos should be stored on.
     *
     * @return string
     */
    protected function levelPhotoDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : 'public';
    }
}
