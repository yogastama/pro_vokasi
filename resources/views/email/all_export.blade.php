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
        </tr>
        @endforeach
    </tbody>
</table>