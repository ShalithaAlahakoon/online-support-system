<?php

namespace Domain\Ticket\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class ReplyTicketFormData extends DataTransferObject
{
    /**
     * ID of the ticket.
     */
    public ?int $ticketId;

    /**
     * email of the ticket.
     *
     * @var string
     */
    public ?string $ticketReplyMessage;
}
