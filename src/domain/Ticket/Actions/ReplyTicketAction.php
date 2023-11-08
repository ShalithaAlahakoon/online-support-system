<?php

namespace Domain\Ticket\Actions;

use App\Http\Resources\ReplyTicketResource;
use Domain\Ticket\DataTransferObjects\ReplyTicketFormData;
use Domain\Ticket\Models\ReplyTicket;
use Domain\Ticket\Models\Ticket;
use Exception;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Mail\ReplyTicketEmail;

class ReplyTicketAction
{

    /**
     * Store sub category action.
     *
     * @param ReplyTicketFormData $replyTicketFormData
     * @return ReplyTicketResource
     * @throws Exception
     */

    public function __invoke(ReplyTicketFormData $replyTicketFormData): ReplyTicketResource
    {
        try {
            DB::beginTransaction();


            /** @var ReplyTicket $replyTicket */
            $replyTicket = ReplyTicket::create([
                'message' => $replyTicketFormData->ticketReplyMessage,
                'ticket_id' => $replyTicketFormData->ticketId,
            ]);

            $ticket = Ticket::findOrFail($replyTicketFormData->ticketId);
            $email = $ticket->email;
            $name = $ticket->name;
            $refNo = $ticket->reference_number;

            Mail::to($email)->send(new ReplyTicketEmail($replyTicket, $name, $refNo));

            DB::commit();

            return new ReplyTicketResource($replyTicket);
        } catch (Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}