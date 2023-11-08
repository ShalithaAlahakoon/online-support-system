<?php

namespace Domain\Ticket\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class TicketFormData extends DataTransferObject
{

    /**
     * problemDescription of the Ticket.
     *
     * @var string|null
     */
    public ?string $referenceNumber;

    /**
     * name of the Ticket.
     *
     * @var string|null
     */
    public ?string $name;

    /**
     * email of the Ticket.
     *
     * @var string|null
     */
    public ?string $email;

    /**
     * phoneNumber of the Ticket.
     *
     * @var string|null
     */
    public ?string $phoneNumber;

    /**
     * problemDescription of the Ticket.
     *
     * @var string|null
     */
    public ?string $problemDescription;

    /**
     * problemDescription of the Ticket.
     *
     * @var string|null
     */
    public ?string $status;

}
