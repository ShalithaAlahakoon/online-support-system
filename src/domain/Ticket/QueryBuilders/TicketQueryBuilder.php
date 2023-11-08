<?php

namespace Domain\Ticket\QueryBuilders;

use Domain\Ticket\Models\Ticket;
use Illuminate\Database\Eloquent\Builder;

/**
 * @template T of Ticket
 * @extends Builder<T>
 */
class TicketQueryBuilder extends Builder
{
    /**
     * Add Ticket filters
     *
     * @return self
     */
    public function filters(): self
    {
        return $this
        ->when(
            request('search'),
            fn ($query) => $query
                ->Where('customer_name', 'LIKE', '%'.request('search').'%')
                ->orWhere('email', 'LIKE', '%'.request('search').'%')
                ->orWhere('reference_number', 'LIKE', '%'.request('search').'%')
        )->when(
            request('entries'),
            fn ($query) => $query
                ->limit(request('entries'))
        )->orderBy('updated_at', 'desc');
    }

    public function withReplyTicket(): Builder
    {
        return $this->with('replyTicket');
    }

    public function resolvedFilters(): self {
        return $this
            ->onlyTrashed()
            ->when(
                request('search'),
                fn ($query) => $query
                    ->where('customer_name', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('email', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('reference_number', 'LIKE', '%' . request('search') . '%')
            )
            ->when(
                request('entries'),
                fn ($query) => $query->limit(request('entries'))
            )
            ->orderBy('updated_at', 'desc');
    }
    
}
