<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasCategoryPhoto
{
    /**
     * Update the category photo.
     *
     * @param  string  $storagePath
     * @return void
     */
    public function updateCategoryPhoto(UploadedFile $photo, $storagePath = 'category-photos')
    {
        tap($this->category_photo_path, function ($previous) use ($photo, $storagePath) {
            $this->forceFill([
                'category_photo_path' => $photo->storePublicly(
                    $storagePath, ['disk' => $this->categoryPhotoDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->categoryPhotoDisk())->delete($previous);
            }
        });
    }

    /**
     * Delete category photo.
     *
     * @return void
     */
    public function deleteCategoryPhoto()
    {

        if (is_null($this->category_photo_path)) {
            return;
        }

        Storage::disk($this->categoryPhotoDisk())->delete($this->category_photo_path);

        $this->forceFill([
            'category_photo_path' => null,
        ])->save();
    }

    /**
     * Get the URL to the category photo.
     */
    public function categoryPhotoUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->category_photo_path
                ? Storage::disk($this->categoryPhotoDisk())->url($this->category_photo_path)
                : '';
        });
    }

    /**
     * Get the disk that category photos should be stored on.
     *
     * @return string
     */
    protected function categoryPhotoDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : 'public';
    }
}
