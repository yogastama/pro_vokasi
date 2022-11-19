@extends('admin.layouts.layout')

@section('head')
<style>
    table {
        width: 100% !important;
    }
</style>
@endsection

@section('content_html')
<h1 class="page-title">
    <i class="voyager-brush"></i> Event {{ $event->title }}
</h1>
<div class="page-content container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <a href="{{ route('voyager.events.download_participant', ['event' => $event->id]) }}" class="btn btn-primary">
                Download Participants
            </a>
        </div>
        <div class="col-xs-12">
            <div class="panel">
                <div class="panel-body">
                    <div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#detail" aria-controls="detail" role="tab" data-toggle="tab">Detail</a></li>
                            <li role="presentation"><a href="#dashboard" aria-controls="dashboard" role="tab" data-toggle="tab">Dashboard</a></li>
                            <li role="presentation"><a href="#target-participants" aria-controls="target-participants" role="tab" data-toggle="tab">Target Participants</a></li>
                            <li role="presentation"><a href="#waiting-verify" aria-controls="waiting-verify" role="tab" data-toggle="tab">Waiting Verify</a></li>
                            <li role="presentation"><a href="#verified-user" aria-controls="verified-user" role="tab" data-toggle="tab">Verified User</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="detail">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>
                                            Title
                                        </th>
                                        <td>
                                            {{ $event->title }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Category
                                        </th>
                                        <td>
                                            {{ $event->category_event->title }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Time
                                        </th>
                                        <td>
                                            {{ $event->start_event }} - {{ $event->close_event }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Time registration
                                        </th>
                                        <td>
                                            {{ $event->start_register_event }} - {{ $event->end_register_event }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Type Event
                                        </th>
                                        <td>
                                            {{ $event->type_event }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Is Active
                                        </th>
                                        <td>
                                            {{ $event->is_active }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Link Zoom
                                        </th>
                                        <td>
                                            <a target="_blank" href="{{ $event->link_zoom }}">{{ $event->link_zoom }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Banner
                                        </th>
                                        <td>
                                            <img src="{{ url('/storage/') . '/' . $event->banner }}" alt="image banner" width="100px">
                                        </td>
                                    </tr>
                                </table>
                                <hr>
                                {!! $event->content !!}
                            </div>
                            <div role="tabpanel" class="tab-pane" id="dashboard">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label for="filter_date">Filter Date</label>
                                            <select name="filter_date" id="filter_date" class="form-control">
                                                <option value="all">All</option>
                                                @foreach($period as $date)
                                                <option {{ $date->format('Y-m-d') == request()->get('date') ? 'selected' : '' }} value="{{ $date->format('Y-m-d') }}">{{ $date->format('d M Y') }}</option>
                                                @endforeach
                                            </select>
                                        </div>
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
                                @if($event->type_event == 'hybrid' || $event->type_event == 'offline')
                                <div class="row">
                                    <div class="col-xs-12 ">
                                        <h3>
                                            List kehadiran
                                        </h3>
                                        <hr>
                                        <div class="table-responsive">

                                            <table class="table table-bordered" id="table-hadir">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            Nama
                                                        </th>
                                                        <th>
                                                            Jenis institusi
                                                        </th>
                                                        <th>
                                                            Institusi
                                                        </th>
                                                        <th>
                                                            Email
                                                        </th>
                                                        <th>
                                                            No telepon
                                                        </th>
                                                        <th>
                                                            Tanggal hadir
                                                        </th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 ">
                                        <h3>
                                            List tidak hadir
                                        </h3>
                                        <hr>
                                        <div class="table-responsive">

                                            <table class="table table-bordered" id="table-tidak-hadir">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            Nama
                                                        </th>
                                                        <th>
                                                            Jenis institusi
                                                        </th>
                                                        <th>
                                                            Institusi
                                                        </th>
                                                        <th>
                                                            Email
                                                        </th>
                                                        <th>
                                                            No telepon
                                                        </th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div role="tabpanel" class="tab-pane" id="target-participants">
                                <form action="{{ route('voyager.events.update_target_participants', ['id_event' => $event->id]) }}" id="form-target-participants" method="POST">
                                    <div class="form-group">
                                        <input @if($target_participants['unit_kemenperin']) checked="checked" @endif type="checkbox" name="target_participants[unit_kemenperin]" id="unit_kemenperin" value="on">
                                        <label for="unit_kemenperin">Unit Pendidikan Tinggi Kemenperin</label>
                                    </div>
                                    <div class="form-group">
                                        <input @if($target_participants['unit_smk_kemenperin']) checked="checked" @endif type="checkbox" name="target_participants[unit_smk_kemenperin]" id="unit_smk_kemenperin" value="on">
                                        <label for="unit_smk_kemenperin">Unit SMK Kemenperin</label>
                                    </div>
                                    <div class="form-group">
                                        <input @if($target_participants['unit_kementrian_lembaga']) checked="checked" @endif type="checkbox" name="target_participants[unit_kementrian_lembaga]" id="unit_kementrian_lembaga" value="on">
                                        <label for="unit_kementrian_lembaga">Unit Kementrian/Lembaga</label>
                                    </div>
                                    <div class="form-group">
                                        <input @if($target_participants['unit_industri']) checked="checked" @endif type="checkbox" name="target_participants[unit_industri]" id="unit_industri" value="on">
                                        <label for="unit_industri">Unit Industri</label>
                                    </div>
                                    <div class="form-group">
                                        <input @if($target_participants['unit_pemerintah_daerah']) checked="checked" @endif type="checkbox" name="target_participants[unit_pemerintah_daerah]" id="unit_pemerintah_daerah" value="on">
                                        <label for="unit_pemerintah_daerah">Unit Pemerintah Daerah</label>
                                    </div>
                                    <div class="form-group">
                                        <input @if($target_participants['lainnya']) checked="checked" @endif type="checkbox" name="target_participants[lainnya]" id="lainnya" value="on">
                                        <label for="lainnya">Lainnya</label>
                                    </div>
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="waiting-verify">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="alert alert-warning">
                                            Mengirimkan link zoom atau qr code dibawah ini artinya anda melakukan
                                            verifikasi pada user tersebut.
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table-waiting-verify" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Nama
                                                </th>
                                                <th>
                                                    Email
                                                </th>
                                                <th>
                                                    Phone Number
                                                </th>
                                                <th>
                                                    Kategori Organisasi
                                                </th>
                                                <th>
                                                    Organisasi
                                                </th>
                                                <th>
                                                    Aksi
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="verified-user">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table-verified" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Nama
                                                </th>
                                                <th>
                                                    Email
                                                </th>
                                                <th>
                                                    Phone Number
                                                </th>
                                                <th>
                                                    Kategori Organisasi
                                                </th>
                                                <th>
                                                    Organisasi
                                                </th>
                                                <th>
                                                    Kirim link zoom
                                                </th>
                                                <th>
                                                    Kirim qr code
                                                </th>
                                                <th>
                                                    Aksi
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
</div>
@endsection
@section('footer_html')
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script>
    $(function() {
        var table = $('#table-waiting-verify').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('voyager.events.get_waiting_verify', ['event' => $event->id, 'type_event' => $event->type_event]) }}",
            columns: [{
                data: 'name',
                name: 'name'
            }, {
                data: 'email',
                name: 'email'
            }, {
                data: 'phone_number',
                name: 'phone_number'
            }, {
                data: 'institution_type',
                name: 'institution_type'
            }, {
                data: 'institution',
                name: 'institution'
            }, {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }, ]
        });
        var tableVerified = $('#table-verified').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('voyager.events.get_verified', ['event' => $event->id, 'type_event' => $event->type_event]) }}",
            columns: [{
                data: 'name',
                name: 'name'
            }, {
                data: 'email',
                name: 'email'
            }, {
                data: 'phone_number',
                name: 'phone_number'
            }, {
                data: 'institution_type',
                name: 'institution_type'
            }, {
                data: 'institution',
                name: 'institution'
            }, {
                data: 'is_sent_zoom_link',
                name: 'is_sent_zoom_link'
            }, {
                data: 'is_sent_qr',
                name: 'is_sent_qr'
            }, {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }, ]
        });
        @if($event->type_event == 'hybrid' || $event->type_event == 'offline')
        var tableHadirOffline = $('#table-hadir').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('voyager.events.table_hadir_event_offline', ['event' => $event->id, 'date' => request()->get('date', 'all')]) }}",
            columns: [{
                data: 'name',
                name: 'name'
            }, {
                data: 'institution_type',
                name: 'institution_type'
            }, {
                data: 'institution',
                name: 'institution'
            }, {
                data: 'email',
                name: 'email'
            }, {
                data: 'phone_number',
                name: 'phone_number'
            }, {
                data: 'hadir',
                name: 'hadir'
            }, ]
        });
        var tableTidakHadir = $('#table-tidak-hadir').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('voyager.events.table_tidak_hadir_event_offline', ['event' => $event->id, 'date' => request()->get('date', 'all')]) }}",
            columns: [{
                data: 'name',
                name: 'name'
            }, {
                data: 'institution_type',
                name: 'institution_type'
            }, {
                data: 'institution',
                name: 'institution'
            }, {
                data: 'email',
                name: 'email'
            }, {
                data: 'phone_number',
                name: 'phone_number'
            }, ]
        });
        @endif
        $('#table-instansi').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });
    });
    $(document).on('click', '.btn-send-qr', function(e) {
        e.preventDefault();
        if (confirm('Apakah anda yakin ingin melakukan verifikasi')) {
            window.location = $(this).attr('href');
        }
    });
    $('#filter_date').change(function (e) { 
        e.preventDefault();
        let url = window.location.protocol + '//' + window.location.host + window.location.pathname + '?date=' + $(this).val();
        window.location.href = url;
    });
</script>
@endsection