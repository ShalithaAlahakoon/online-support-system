<?php

namespace Domain\Ticket\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Domain\Ticket\Models\Ticket;


class ReplyTicket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ticket_id',
        'message',
    ];

    protected $dates = ['deleted_at'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

}
