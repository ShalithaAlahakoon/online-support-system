<?php

namespace Domain\User\DataTransferObjects;

use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\DataTransferObject;

class UserFormData extends DataTransferObject
{
    /**
     * first name of the user.
     */
    public ?string $firstName;

    /**
     * last name of the user.
     */
    public ?string $lastName;

    /**
     * name of the user.
     */
    public ?string $name;

    /**
     * Email of the user.
     */
    public ?string $email;

    /**
     * Password of the user.
     */
    public ?string $password;

    /**
     * role id of the user.
     */
    public ?int $roleId;

    /**
     * phone number of the user.
     */
    public ?string $phoneNumber;

    /**
     * postal address of the user.
     */
    public ?string $postalAddress;

    /**
     * postal address of the user.
     */
    public ?UploadedFile $photo;

    /**
     * status of the user.
     */
    public ?int $status;

    /**
     * country id of the user.
     */
    public ?int $countryId;

    /**
     * about of the user.
     */
    public ?string $aboutMe;
}
