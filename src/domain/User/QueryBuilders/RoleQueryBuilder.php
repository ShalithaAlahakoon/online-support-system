<?php

namespace Domain\User\QueryBuilders;

use Domain\User\Models\Role;
use Illuminate\Database\Eloquent\Builder;

/**
 * @template T of Role
 *
 * @extends Builder<T>
 */
class RoleQueryBuilder extends Builder
{
    /**
     *  Add role filters
     */
    public function filters(): self
    {
        return $this
            ->with('permissions')
            ->orderBy('created_at', 'desc')
            ->when(
                request('search'),
                fn ($query) => $query
                    ->where('name', 'LIKE', '%'.request('search').'%')
                    ->orWhere('description', 'LIKE', '%'.request('search').'%')
            )->when(
                request('entries'),
                fn ($query) => $query
                    ->limit(request('entries'))
            );
    }
}
