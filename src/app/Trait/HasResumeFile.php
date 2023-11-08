<?php

namespace App\Trait;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasResumeFile
{
    /**
     * Update the instructor's resume file.
     *
     * @param UploadedFile $file
     * @param string $storagePath
     * @return void
     */
    public function updateResumeFile(UploadedFile $file, string $storagePath = 'instructor-resume'): void
    {
        tap($this->resume_path, function ($previous) use ($file, $storagePath) {
            $this->forceFill([
                'resume_path' => $file->storePublicly(
                    $storagePath, ['disk' => $this->instructorResumeDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->instructorResumeDisk())->delete($previous);
            }
        });
    }

    /**
     * Delete the instructor's resume file.
     *
     * @return void
     */
    public function deleteResumeFile(): void
    {
        if (is_null($this->resume_path)) {
            return;
        }

        Storage::disk($this->instructorResumeDisk())->delete($this->resume_path);

        $this->forceFill([
            'resume_path' => null,
        ])->save();
    }

    /**
     * Get the URL to the user's profile photo.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function resumeUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->resume_path
                ? Storage::disk($this->instructorResumeDisk())->url($this->resume_path)
                : '';
        });
    }

    /**
     * Get the disk that profile photos should be stored on.
     *
     * @return string
     */
    protected function instructorResumeDisk(): string
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : 'public';
    }
}
