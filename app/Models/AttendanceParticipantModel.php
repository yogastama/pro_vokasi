<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttendanceParticipantModel extends Model
{
    use SoftDeletes;
    protected $table = 'attendance_participants';
    protected $guarded = [];
}
