@extends('admin.layouts.layout', [
    'title' => 'Dashboard event ' . ($event ? $event->title : '')
])

@section('content_html')
<div class="container-fluid" style="margin-top: 20px;">
    <div class="panel">
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-4">
                    <div class="form-group">
                        <label for="event">Event</label>
                        <select name="event" id="event" class="form-control select2">
                            <option value="all">All</option>
                            @foreach ($events as $item)
                            <option value="{{ $item->id }}" {{ request()->get('event_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12">
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <h3>
                        Counter
                    </h3>
                    <hr>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div style="padding: 10px;border:1px solid #111;border-radius:10px;">
                                <h2>
                                    {{ $total_event_participants }}
                                </h2>
                                <p>
                                    Total peserta
                                </p>
                            </div>
                        </div>
                        @if(request()->get('event_id') != 'all')
                            @if($event->type_event == 'hybrid' || $event->type_event == 'offline')
                            <div class="col-xs-12 col-sm-6">
                                <div style="padding: 10px;border:1px solid #111;border-radius:10px;">
                                    <h2>
                                        {{ $total_peserta_hadir }}
                                    </h2>
                                    <p>
                                        Total peserta hadir
                                    </p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div style="padding: 10px;border:1px solid #111;border-radius:10px;">
                                    <h2>
                                        {{ $total_peserta_tidak_hadir }}
                                    </h2>
                                    <p>
                                        Total peserta tidak hadir
                                    </p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div style="padding: 10px;border:1px solid #111;border-radius:10px;">
                                    <h2>
                                        {{ $total_peserta_undangan_offline }}
                                    </h2>
                                    <p>
                                        Total peserta dikirimkan undangan offline
                                    </p>
                                </div>
                            </div>
                            @endif
                        @endif
                        @if(request()->get('event_id') != 'all')
                            @if($event->type_event == 'hybrid' || $event->type_event == 'online')
                            <div class="col-xs-12 col-sm-6">
                                <div style="padding: 10px;border:1px solid #111;border-radius:10px;">
                                    <h2>
                                        {{ $total_peserta_undangan_online }}
                                    </h2>
                                    <p>
                                        Total peserta dikirimkan link zoom
                                    </p>
                                </div>
                            </div>
                            @endif
                        @endif
                        @if(request()->get('event_id') != 'all')
                            @if($event->type_event == 'hybrid')
                            <div class="col-xs-12 col-sm-6">
                                <div style="padding: 10px;border:1px solid #111;border-radius:10px;">
                                    <h2>
                                        {{ $total_peserta_undangan_keduanya }}
                                    </h2>
                                    <p>
                                        Total peserta dikirimkan undangan offline & link zoom
                                    </p>
                                </div>
                            </div>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <h3>
                        Instansi & total terdaftar
                    </h3>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table-instansi">
                            <thead>
                                <tr>
                                    <th>
                                        No
                                    </th>
                                    <th>
                                        Instance
                                    </th>
                                    <th>
                                        Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($instansi as $item)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>{{ $item->institution }}</td>
                                    <td>{{ $item->total }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_html')
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script>
    $('#table-instansi').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
        ]
    });
    $('#event').change(function (e) {
        e.preventDefault();
        window.location = "{{ route('voyager.dashboard') }}?event_id=" + $(this).val();
    });
    $(function () {
        var table = $('#table-list-peserta').DataTable({
            processing: true,
            serverSide: true,
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
            ajax: "{{ route('voyager.table_list_participants', ['event_id' => $event->id ?? '']) }}",
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone_number',
                    name: 'phone_number'
                },
                {
                    data: 'gender',
                    name: 'gender'
                },
                {
                    data: 'institution',
                    name: 'institution'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

    });

</script>
@endsection
