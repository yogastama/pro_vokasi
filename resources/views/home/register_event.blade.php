@extends('home.layout', [
'menu' => 'events'
])

@section('content')
<div class="row" style="margin-top: 120px;margin-left:0px;margin-right:0px;padding-bottom: 100px;">
    <div class="col-12 px-4">
        <h3>
            Form Pendaftaran
        </h3>
        <hr>
    </div>
    <div class="row mt-3">
        <div class="col-12 px-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <img src="{{ url('/storage/' . $event->banner) }}" alt="" width="100%">
                                </div>
                                <div class="col-8">
                                    <b>
                                        {{ $event->title }}
                                    </b>
                                    <div style="font-size: 10px" class="mt-2">
                                        <i class="fa-solid fa-calendar"></i>
                                        {{ date('d M Y H:i', strtotime($event->start_event)) }} -
                                        {{ date('d M Y H:i', strtotime($event->close_event)) }}
                                    </div>
                                    <div class="mt-2">
                                        <div class="badge text-bg-warning">{{ $event->category_event->title }}</div>
                                        <span class="badge text-bg-info">{{ ucwords($event->type_event) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <div class="alert alert-warning">
                        Silakan lengkapi & cek kembali form di bawah ini.
                    </div>
                    <div class="alert alert-danger alert-no-login d-none">
                        Anda belum login ke aplikasi provokasi, silakan <a href="{{ url('/accounts/register') }}">Daftar disini</a> atau <a href="{{ url('/accounts/login') }}">Masuk disini</a>.
                    </div>
                </div>
                <div class="col-12">
                    <form action="{{ route('event.save_register', ['id' => $event->id]) }}" id="form-participant" method="POST">
                        @csrf
                        @method('POST')
                        <!-- <div class="form-group mt-2">
                            <label for="name">Nama</label>
                        </div> -->
                        <!-- <div class="form-group mt-2">
                            <label for="email">Email</label>
                        </div> -->
                        <input type="hidden" class="form-control" name="name" id="name">
                        <input type="hidden" class="form-control" name="email" id="email">
                        <div class="form-group mt-2">
                            <label for="instansi">Nama Instansi</label>
                            <input type="text" class="form-control" name="instansi" id="instansi">
                        </div>
                        <div class="form-group mt-2">
                            <label for="jenis_instansi">Jenis Instansi</label>
                            <select name="jenis_instansi" id="jenis_instansi" class="form-control">
                                @foreach($participant_recommendations as $participant)
                                <option value="{{ $participant->key }}">{{ $participant->value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone">
                            <small class="text-muted">Contoh : 089617565844</small>
                        </div>
                        <div class="form-group mt-2">
                            <label for="jenis_kelamin">Jenis kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                <option value="laki_laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>
                        <input type="hidden" name="token_siva" id="token_siva">
                        <div class="d-grid gap-2 mt-3">
                            <button class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    function renderValueFormEvent() {
        if (localStorage.getItem('name_siva')) {
            $('#name').val(localStorage.getItem('name_siva'));
            // $('#name').attr('readonly', 'true');
        }
        if (localStorage.getItem('email_siva')) {
            $('#email').val(localStorage.getItem('email_siva'));
            // $('#email').attr('readonly', 'true');
        }
        if (localStorage.getItem('institution_siva')) {
            $('#instansi').val(localStorage.getItem('institution_siva'));
            // $('#instansi').attr('readonly', 'true');
        }
        $('#token_siva').val(localStorage.getItem('token_siva'));
    }
    renderValueFormEvent();
    $('#form-participant').submit(function(e) {
        if (!localStorage.getItem('name_siva')) {
            e.preventDefault();
            notie.alert({
                type: 'error',
                text: 'Silakan login terlebih dahulu!',
                stay: false,
                time: 10,
                position: 'top'
            })
            setTimeout(() => {
                window.location = '/accounts/login';
            }, 2000);
        }
    });
    if (!localStorage.getItem('token_siva')) {
        $('.alert-no-login').removeClass('d-none');
    }
</script>
@endsection