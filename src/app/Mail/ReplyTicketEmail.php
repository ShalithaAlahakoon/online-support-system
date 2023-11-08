<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Domain\Ticket\Models\ReplyTicket;


class ReplyTicketEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $replyTicket;
    public $name;
    public $refNo;
    /**
     * Create a new message instance.
     */
    public function __construct(ReplyTicket $replyTicket, $name, $refNo)
    {
        $this->replyTicket = $replyTicket;
        $this->name = $name;
        $this->refNo = $refNo;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reply Ticket',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.ReplyTicketEmailTemplate',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}