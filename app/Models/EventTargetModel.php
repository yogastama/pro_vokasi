<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventTargetModel extends Model
{
    use SoftDeletes;
    protected $table = 'event_targets';
    protected $guarded = [];
}
