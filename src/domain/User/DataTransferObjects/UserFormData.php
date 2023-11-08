<?php

namespace Domain\User\DataTransferObjects;

use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\DataTransferObject;

class UserFormData extends DataTransferObject
{
    /**
     * first name of the user.
     *
     * @var string|null
     */
    public ?string $firstName;

    /**
     * last name of the user.
     *
     * @var string|null
     */
    public ?string $lastName;

    /**
     * name of the user.
     *
     * @var string|null
     */
    public ?string $name;

    /**
     * Email of the user.
     *
     * @var string|null
     */
    public ?string $email;


    /**
     * Password of the user.
     *
     * @var string|null
     */
    public ?string $password;


    /**
     * role id of the user.
     *
     * @var int|null
     */
    public ?int $roleId;


    /**
     * phone number of the user.
     *
     * @var string|null
     */
    public ?string $phoneNumber;


    /**
     * postal address of the user.
     *
     * @var string|null
     */
    public ?string $postalAddress;


    /**
     * postal address of the user.
     *
     * @var UploadedFile|null
     */
    public ?UploadedFile $photo;


    /**
     * status of the user.
     *
     * @var int|null
     */
    public ?int $status;


    /**
     * country id of the user.
     *
     * @var int|null
     */
    public ?int $countryId;


    /**
     * about of the user.
     *
     * @var string|null
     */
    public ?string $aboutMe;
}
