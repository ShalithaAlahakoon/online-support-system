<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasPageSectionFieldFile
{
    /**
     * Update the user's ID card photo.
     *
     * @param  string  $storagePath
     * @return void
     */
    public function updateFieldFile(UploadedFile $photo, $storagePath = 'page-section-field-files')
    {
        tap($this->value, function ($previous) use ($photo, $storagePath) {
            $this->forceFill([
                'file_path' => $photo->storePublicly(
                    $storagePath, ['disk' => $this->pageSectionFieldFileDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->pageSectionFieldFileDisk())->delete($previous);
            }
        });
    }

    /**
     * Delete the user's ID card photo.
     *
     * @return void
     */
    public function deletePageSectionFieldFile()
    {
        if (is_null($this->value)) {
            return;
        }

        Storage::disk($this->pageSectionFieldFileDisk())->delete($this->value);

        $this->forceFill([
            'value' => null,
        ])->save();
    }

    /**
     * Get the URL to the user's ID card photo.
     */
    public function pageSectionfieldFileUrl(): Attribute
    {

        return Attribute::get(function () {
            return $this->file_path
                ? Storage::disk($this->pageSectionFieldFileDisk())->url($this->file_path)
                : $this->defaultPageSectionFieldFileUrl();
        });
    }

    /**
     * Get the default ID card photo URL if no photo has been uploaded.
     *
     * @return string
     */
    protected function defaultPageSectionFieldFileUrl()
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
    protected function pageSectionfieldFileDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('jetstream.page_section_field_file_disk', 'public');
    }
}
