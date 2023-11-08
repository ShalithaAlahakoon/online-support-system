<?php

namespace Domain\Ticket\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class TicketFormData extends DataTransferObject
{
    /**
     * problemDescription of the Ticket.
     */
    public ?string $referenceNumber;

    /**
     * name of the Ticket.
     */
    public ?string $name;

    /**
     * email of the Ticket.
     */
    public ?string $email;

    /**
     * phoneNumber of the Ticket.
     */
    public ?string $phoneNumber;

    /**
     * problemDescription of the Ticket.
     */
    public ?string $problemDescription;

    /**
     * problemDescription of the Ticket.
     */
    public ?string $status;
}
