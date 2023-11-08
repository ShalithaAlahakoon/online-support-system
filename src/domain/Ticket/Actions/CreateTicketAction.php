<?php

namespace Domain\Ticket\Actions;

use App\Http\Resources\TicketResource;
use App\Mail\ConfirmTicketEmail;
use Domain\Ticket\DataTransferObjects\TicketFormData;
use Domain\Ticket\Models\Ticket;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mail;

class CreateTicketAction
{
    /**
     * Store faq action.
     *
     * @throws Exception
     */
    public function __invoke(TicketFormData $ticketFormData): TicketResource
    {
        try {
            DB::beginTransaction();

            $referenceNumber = strtoupper(Str::random(10)).'-'.date('YmdHis');

            /** @var Ticket $ticket */
            $ticket = Ticket::create([
                'reference_number' => $referenceNumber,
                'customer_name' => $ticketFormData->name,
                'email' => $ticketFormData->email,
                'problem_description' => $ticketFormData->problemDescription,
                'phone_number' => $ticketFormData->phoneNumber,
                'status' => $ticketFormData->status,
            ]);

            Mail::to($ticketFormData->email)->send(new ConfirmTicketEmail($referenceNumber, $ticketFormData->name));

            DB::commit();

            return new ticketResource($ticket);
        } catch (Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
