<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasSubCategoryPhoto
{
    /**
     * Update the category photo.
     *
     * @param  \Illuminate\Http\UploadedFile  $photo
     * @param  string  $storagePath
     * @return void
     */
    public function updateSubCategoryPhoto(UploadedFile $photo, $storagePath = 'sub-category-photos')
    {
        tap($this->sub_category_photo_path, function ($previous) use ($photo, $storagePath) {
            $this->forceFill([
                'sub_category_photo_path' => $photo->storePublicly(
                    $storagePath, ['disk' => $this->subCategoryPhotoDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->subCategoryPhotoDisk())->delete($previous);
            }
        });
    }

    /**
     * Delete sub category photo.
     *
     * @return void
     */
    public function deleteSubCategoryPhoto()
    {

        if (is_null($this->sub_category_photo_path)) {
            return;
        }

        Storage::disk($this->subCategoryPhotoDisk())->delete($this->sub_category_photo_path);

        $this->forceFill([
            'sub_category_photo_path' => null,
        ])->save();
    }

    /**
     * Get the URL to the category photo.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function subCategoryPhotoUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->sub_category_photo_path
                ? Storage::disk($this->subCategoryPhotoDisk())->url($this->sub_category_photo_path)
                : '';
        });
    }



    /**
     * Get the disk that sub category photos should be stored on.
     *
     * @return string
     */
    protected function subCategoryPhotoDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : 'public';
    }
}
