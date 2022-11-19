<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventParticipantModel extends Model
{
    use SoftDeletes;
    protected $table = 'event_participants';
    protected $guarded = [];
    public function attendance_participant()
    {
        return $this->hasOne(AttendanceParticipantModel::class, 'id_participant', 'id');
    }
}
