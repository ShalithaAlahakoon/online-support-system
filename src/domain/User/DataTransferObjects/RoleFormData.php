<?php

namespace Domain\User\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class RoleFormData extends DataTransferObject
{
    /**
     * name of role.
     */
    public ?string $name;

    /**
     * description of role.
     */
    public ?string $description;

    /**
     * permissions of the role.
     */
    public ?array $permissions;

    /**
     * status of the role.
     */
    public ?int $status;

    /**
     * guard name of the role.
     */
    public ?string $guardName;
}
