<?php

namespace Domain\User\Models;

use Domain\User\QueryBuilders\RoleQueryBuilder;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return RoleQueryBuilder
     */
    public function newEloquentBuilder($query)
    {
        return new RoleQueryBuilder($query);
    }
}
