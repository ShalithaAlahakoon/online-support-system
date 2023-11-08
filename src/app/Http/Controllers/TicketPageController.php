<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyTicketFormRequest;
use App\Http\Requests\TicketFormRequest;
use Domain\Ticket\Actions\CreateTicketAction;
use Domain\Ticket\Actions\DeleteTicketAction;
use Domain\Ticket\Actions\ReplyTicketAction;
use Domain\Ticket\DataTransferObjects\ReplyTicketFormData;
use Domain\Ticket\DataTransferObjects\TicketFormData;
use Domain\Ticket\Models\Ticket;
use Exception;
use Illuminate\Http\Request;
use Inertia\Response;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\DB;
class TicketPageController extends Controller
{
    /**
     * Show the general tickets information screen.
     */
    public function index(Request $request)
    {
        return Jetstream::inertia()->render($request, 'Ticket/Index', [
            'tickets' => Ticket::query()->with('replyTicket')->filters()->paginate(request('entries') ?? 10)->appends($request->except('page')),
            'requestParam' => $request->all() ?? null,
        ]);
    }

    /**
     * Show the store ticket information screen.
     */
    public function create()
    {
        return Jetstream::inertia()->render(request(), 'Ticket/Create');
    }

    /**
     * Store a newly created ticket resource in storage.
     */
    public function store(
        TicketFormRequest $ticketFormRequest,
        CreateTicketAction $createTicketAction
    ): Response {
        try {
            $createTicketAction(
                new TicketFormData(
                    referenceNumber: $ticketFormRequest->reference_number,
                    name: $ticketFormRequest->name,
                    problemDescription: $ticketFormRequest->problem_description,
                    email: $ticketFormRequest->email,
                    phoneNumber: $ticketFormRequest->phone_number,
                    status: $ticketFormRequest->status
                )
            );

            return Jetstream::inertia()->render($ticketFormRequest, 'Welcome', [
                'tickets' => Ticket::query()->filters()->paginate(10),
                'message' => 'Ticket successfully created.',
            ]);
        } catch (Exception $exception) {
            return Jetstream::inertia()->render($ticketFormRequest, 'Welcome', [
                'tickets' => Ticket::query()->filters()->paginate(10),
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Send reply resource in storage.
     */
    public function sendReply(
        ReplyTicketFormRequest $replyTicketFormRequest,
        ReplyTicketAction $replyTicketAction
    ): Response {
        try {
            $replyTicketAction(
                new ReplyTicketFormData(
                    ticketId: $replyTicketFormRequest->ticket_id,
                    ticketReplyMessage: $replyTicketFormRequest->ticket_reply_message,
                )
            );

            return Jetstream::inertia()->render($replyTicketFormRequest, 'Ticket/Index', [
                'tickets' => Ticket::query()->filters()->paginate(10),
                'message' => 'Reply ticket successfull.',
            ]);
        } catch (Exception $exception) {
            return Jetstream::inertia()->render($replyTicketFormRequest, 'Ticket/Index', [
                'tickets' => Ticket::query()->filters()->paginate(10),
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified ticket resource from storage.
     *
     * @param  TicketFormRequest  $ticketFormRequest,
     */
    public function destroy(
        TicketFormRequest $ticketFormRequest,
        DeleteTicketAction $deleteTicketAction
    ): Response {
        try {
            $deleteTicketAction($ticketFormRequest);

            return Jetstream::inertia()->render($ticketFormRequest, 'Ticket/Index', [
                'tickets' => Ticket::query()->filters()->paginate(10),
                'message' => 'Ticket successfully deleted.',
            ]);
        } catch (Exception $exception) {
            return Jetstream::inertia()->render($ticketFormRequest, 'Ticket/Index', [
                'tickets' => Ticket::query()->filters()->paginate(10),
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Show the deleted Ticket information screen.
     */
    public function resolvedTicketIndex(Request $request)
    {
        return Jetstream::inertia()->render($request, 'Ticket/ResolvedTicketIndex', [
            'resolvedTickets' => Ticket::resolvedFilters()->paginate(request('entries') ?? 10),
        ]);
    }

    /**
     * Restore data
     */
    public function restore($TicketId)
    {
        try {
            $ticket = Ticket::resolvedFilters()->findOrFail($TicketId);
            $ticket->restore();

            return Jetstream::inertia()->render(request(), 'Ticket/ResolvedTicketIndex', [
                'resolvedTickets' => Ticket::resolvedFilters()->paginate(request('entries') ?? 10),
                'message' => 'Ticket successfully restored.',
            ]);
        } catch (Exception $exception) {
            return Jetstream::inertia()->render(request(), 'Ticket/ResolvedTicketIndex', [
                'resolvedTickets' => Ticket::resolvedFilters()->paginate(request('entries') ?? 10),
                'error' => $exception->getMessage(),
            ]);
        }
    }
    
    /**
     * check status
     */
    public function status(Request $request)
    {
        $ticket = DB::select('SELECT * FROM tickets WHERE reference_number = ?', [$request->reference_number]);
        if ($ticket) {
            return Jetstream::inertia()->render(request(), 'Ticket/Track', [
                'ticket' => $ticket,
            ]);
        } else {
            return Jetstream::inertia()->render(request(), 'Ticket/Track', [
                'error' => 'Ticket not found.',
            ]);
        }
    }

   
}
