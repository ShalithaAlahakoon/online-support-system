<?php
namespace Domain\Ticket\Actions;

use App\Http\Requests\TicketFormRequest;
use Domain\Ticket\Models\Ticket;
use Exception;
use Illuminate\Support\Facades\DB;

class DeleteTicketAction
{
        /**
     * Delete Ticket action.
     *
     * @param TicketFormRequest $ticketFormRequest
     * @return true
     * @throws Exception
     */
    public function __invoke(TicketFormRequest $ticketFormRequest)
    {
        try {
            DB::beginTransaction();
            Ticket::find($ticketFormRequest->id)->delete();
            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}