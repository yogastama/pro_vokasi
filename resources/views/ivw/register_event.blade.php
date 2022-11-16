@extends('ivw.layouts.layout')

@section('content')
<div class="container" style="margin-bottom:50px !important;margin-top:30px !important;">
    <h2>Registrasi Pro-Vokasi</h2>
    <p class="text-light">
        Event : {{ $event->title }}
    </p>
    <hr style="background: #ffffff">
    <div class="alert alert-light">
        Silakan lengkapi bagian yang belum terisi.
    </div>
    <div class="alert alert-danger alert-no-login d-none">
        Anda belum login ke aplikasi provokasi, silakan <a href="{{ url('/desktop/register') }}">Daftar disini</a> atau <a href="{{ url('/desktop/login') }}">Masuk disini</a>.
    </div>
    <form action="{{ route('event.save_register', ['id' => $event->id]) }}" method="POST" id="form-participant">
        @csrf
        @method('POST')
        <span class="field">
            Nama Perusahaan <span style="color:red;">*</span>
        </span>
        <span class="content">
            <input type="text" class="isian" name="instansi" id="instansi">
        </span>
        <div style="clear:both"></div>

        <span class="field">
            Nama Peserta <span style="color:red;">*</span>
        </span>
        <span class="content">
            <input type="text" class="isian" name="name" id="name">
        </span>
        <div style="clear:both"></div>

        {{-- <span class="field">
            Jabatan <span style="color:red;">*</span>
        </span>
        <span class="content">
            <input type="text" class="isian" name="title" id="title">
        </span>
        <div style="clear:both"></div> --}}

        <span class="field">
            Alamat Email <span style="color:red;">*</span>
        </span>
        <span class="content">
            <input type="email" class="isian" name="email" id="email">
        </span>
        <div style="clear:both"></div>

        <span class="field">
            Nomor Handphone (Whatsapp) <span style="color:red;">*</span>
        </span>
        <span class="content">
            <input type="text" class="isian" name="phone" id="phone">
        </span>
        <div style="clear:both"></div>

        <span class="field">
            Jenis kelamin <span style="color:red;">*</span>
        </span>
        <span class="content">
            <select name="jenis_kelamin" id="jenis_kelamin" class="isian">
                <option value="laki_laki">Laki-laki</option>
                <option value="perempuan">Perempuan</option>
            </select>
        </span>
        <div style="clear:both"></div>

        {{-- <span class="field">
            ID Zoom <span style="color:red;">*</span>
        </span>
        <span class="content">
            <input type="text" class="isian" name="zoom" id="zoom">
        </span>
        <div style="clear:both"></div> --}}

        <span style="color:red;">*</span> <span style="color:#ffffff;font-size:11px;">Wajib diisi</span>
        <div style="clear:both"></div>

        <span class="field nofield">&nbsp;</span>
        <input type="hidden" name="token_siva" id="token_siva">
        <span class="content">
            <input type='hidden' name='q' value=>
            <input type="submit" class="buttonreg register" value="Submit" style="border:0px solid;background-color:red;color:#ffffff !important;">
        </span>


        <div style="clear:both"></div>
        <div style="width:100%;color:#ffffff;line-height:11px;font-size:11px;margin-top:20px;margin-bottom:20px;">
            Dengan mengisi kolom registrasi ini, Anda tidak berkeberatan data Anda digunakan untuk kepentingan
            kegiatan Industrial Vocational Week 2022 & Industrial Vocational Year 2023 dan program lainnya. Data tidak disalahgunakan dan tidak untuk
            kepentingan komersial.
        </div>

    </form>
</div>
@endsection

@section('javascript')
<script>
    function renderValueFormEvent() {
        if (localStorage.getItem('name_siva')) {
            $('#name').val(localStorage.getItem('name_siva'));
            $('#name').attr('readonly', 'readonly');
        }
        if (localStorage.getItem('institution_siva')) {
            $('#instansi').val(localStorage.getItem('institution_siva'));
            $('#instansi').attr('readonly', 'readonly');
        }
        if (localStorage.getItem('email_siva')) {
            $('#email').val(localStorage.getItem('email_siva'));
            $('#email').attr('readonly', 'readonly');
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
                window.location = "{{ url('/desktop/register') }}";
            }, 2000);
        }
    });
    if (!localStorage.getItem('token_siva')) {
        $('.alert-no-login').removeClass('d-none');
    }
</script>
@endsection