<?php

namespace App\Exports\EventParticipant;

use App\Models\EventParticipantModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AllExport implements FromView
{
    public $id_event;
    public function __construct($id_event)
    {
        $this->id_event = $id_event;
    }
    public function view(): View
    {
        $participants = EventParticipantModel::where('event_id', $this->id_event)->get();
        $data = [
            'participants' => $participants
        ];
        return view('email.all_export', $data);
    }
}
