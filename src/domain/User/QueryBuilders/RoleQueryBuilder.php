<?php

namespace Domain\User\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;
use Domain\User\Models\Role;

/**
 * @template T of Role
 * @extends Builder<T>
 */
class RoleQueryBuilder extends Builder
{
    /**
     *  Add role filters
     *
     * @return self
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
