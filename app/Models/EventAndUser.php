<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventAndUser extends Model
{
    use HasFactory;

    protected $table = 'event_and_users';

    protected $fillable = [
        'events_id',
        'users_id',

    ];
}
