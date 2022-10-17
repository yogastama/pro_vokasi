<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventParticipantModel extends Model
{
    use SoftDeletes;
    protected $table = 'event_participants';
    protected $guarded = [];
}
