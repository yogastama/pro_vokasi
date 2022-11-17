@extends('admin.layouts.layout')

@section('content_html')
<h1 class="page-title">
    <i class="voyager-brush"></i> Event {{ $event->title }}
</h1>
<div class="page-content container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel">
                <div class="panel-body">
                    <div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#detail" aria-controls="detail" role="tab" data-toggle="tab">Detail</a></li>
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
                data: 'is_sent_qr',
                name: 'is_sent_qr'
            }, {
                data: 'is_sent_zoom_link',
                name: 'is_sent_zoom_link'
            }, {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }, ]
        });
    });
    $(document).on('click', '.btn-send-qr', function(e) {
        e.preventDefault();
        if (confirm('Apakah anda yakin ingin melakukan verifikasi')) {
            window.location = $(this).attr('href');
        }
    });
</script>
@endsection