<?php

namespace Domain\Ticket\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Domain\Ticket\QueryBuilders\TicketQueryBuilder;
use Domain\Ticket\Models\ReplyTicket;


class Ticket extends Model
{
    use HasFactory,softDeletes;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reference_number',
        'customer_name',
        'problem_description',
        'email',
        'phone_number',
        'status'

    ];

    protected $dates = ['deleted_at'];

    public function replyTicket()
    {
        return $this->hasMany(ReplyTicket::class);
    }


     /**
     * Create a new Eloquent query builder for the model.
     *
     * @param \Illuminate\Database\Query\Builder $query
     *
     * @return TicketQueryBuilder
     */
    public function newEloquentBuilder($query)
    {
        return new TicketQueryBuilder($query);
    }
    
}
