@extends('admin.layouts.layout', [
    'title' => 'Dashboard event ' . $event->title
])

@section('content_html')
<div class="container-fluid" style="margin-top: 20px;">
    <div class="row">
        <div class="col-md-4">
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <h3>
                                Dashboard App
                            </h3>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel" style="background: rgb(104, 212, 255);color:#fff;">
                                <div class="panel-body">
                                    <b>
                                        TOTAL USER TERDAFTAR
                                    </b>
                                    <h3>
                                        {{ $total_user_customer }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <h3>
                                Dashboard Event
                            </h3>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="event">Event</label>
                                <select name="event" id="event" class="form-control select2">
                                    @foreach ($events as $item)
                                    <option value="{{ $item->id }}" {{ $event->id == $item->id ? 'selected' : '' }}>
                                        {{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="panel" style="background: rgb(104, 212, 255);color:#fff;">
                                        <div class="panel-body">
                                            <b>
                                                JUMLAH PENDAFTAR
                                            </b>
                                            <h3>
                                                {{ $jumlah_pendaftar_event }}
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="panel" style="background: rgb(104, 212, 255);color:#fff;">
                                        <div class="panel-body">
                                            <b>
                                                TOTAL PENDAFTAR DALAM 3 HARI TERAKHIR
                                            </b>
                                            <h3>
                                                {{ $jumlah_pendaftar_event_3_hari_terakhir }}
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <b>
                                INSTANSI & TOTAL TERDAFTAR
                            </b>
                            <hr>
                            <table class="table table-bordered" id="table-list-instance">
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
                                    @foreach ($instance_with_total_users as $item)
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
                            <b>
                                PESERTA
                            </b>
                            <hr>
                            <div class="alert alert-warning">
                                Jika anda ingin menghapus peserta, anda bisa masuk ke detail peserta tersebut.
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table-list-peserta">
                                    <thead>
                                        <tr>
                                            <th>
                                                Nama
                                            </th>
                                            <th>
                                                Email
                                            </th>
                                            <th>
                                                Phone
                                            </th>
                                            <th>
                                                Gender
                                            </th>
                                            <th>
                                                Instansi
                                            </th>
                                            <th>
                                                Mendaftar pada
                                            </th>
                                            <th>
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
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
    $('#table-list-instance').DataTable({
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
            ajax: "{{ route('voyager.table_list_participants', ['event_id' => $event->id]) }}",
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
