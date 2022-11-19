<table>
    <thead>
        <tr>
            <th style="background: yellow;">
                <b>Nama</b>
            </th>
            <th style="background: yellow;">
                <b>Email</b>
            </th>
            <th style="background: yellow;">
                <b>Phone Number</b>
            </th>
            <th style="background: yellow;">
                <b>Kategori Organisasi</b>
            </th>
            <th style="background: yellow;">
                <b>Organisasi</b>
            </th>
            <th style="background: yellow;">
                <b>Kirim Link Zoom</b>
            </th>
            <th style="background: yellow;">
                <b>Kirim Qr Code</b>
            </th>
            @if($event->type_event == 'hybrid')
            <th style="background: yellow;">
                <b>Status Hadir Offline</b>
            </th>
            <th style="background: yellow;">
                <b>Tanggal Hadir</b>
            </th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($participants as $participant)
        <tr>
            <td>{{ $participant->name }}</td>
            <td>{{ $participant->email }}</td>
            <td>{{ $participant->phone_number }}</td>
            <td>{{ str_replace('_', ' ', $participant->institution_type) }}</td>
            <td>{{ $participant->institution }}</td>
            <td>{{ $participant->is_sent_zoom_link }}</td>
            <td>{{ $participant->is_sent_qr }}</td>
            @php
            $hadir = \App\Models\AttendanceParticipantModel::where('id_event', $participant->event_id)->where('id_participant', $participant->id)->first();
            @endphp
            @if($hadir)
            <td style="background-color: green">
                yes
            </td>
            <td style="background-color: green">
                {{ $hadir->created_at }}
            </td>
            @else
            <td></td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>