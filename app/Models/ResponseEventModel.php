<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResponseEventModel extends Model
{
    use SoftDeletes;
    protected $table = 'response_events';
    protected $guarded = [];
}
