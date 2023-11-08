<?php

namespace Domain\User\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class RoleFormData extends DataTransferObject
{
    /**
     * name of role.
     *
     * @var string|null
     */
    public ?string $name;

    /**
     * description of role.
     *
     * @var string|null
     */
    public ?string $description;

    /**
     * permissions of the role.
     *
     * @var array|null
     */
    public ?array $permissions;

    /**
     * status of the role.
     *
     * @var int|null
     */
    public ?int $status;

    /**
     * guard name of the role.
     *
     * @var string|null
     */
    public ?string $guardName;
}
