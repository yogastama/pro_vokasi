@extends('home.layout', [
'menu' => 'account'
])

@section('content')
<div class="row" style="margin-top: 140px;margin-left:0px;margin-right:0px;padding-bottom:150px;">
    <div class="col-12 px-4">
        <h2>
            Daftar
        </h2>
    </div>
    <div class="col-12 px-4 mt-4">
        <form action="{{ route('accounts.process_register') }}" method="POST" id="form-register">
            @csrf
            @method('POST')
            <div class="form-group mt-3">
                <label for="name">Nama</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group mt-3">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username">
            </div>
            <div class="form-group mt-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="form-group mt-3">
                <label for="jenis_institusi">Jenis Institusi</label>
                <select name="jenis_institusi" id="jenis_institusi" class="form-control">
                    <option value="unit_kemenperin">Unit Pendidikan Tinggi Kemenperin</option>
                    <option value="unit_smk_kemenperin">Unit SMK Kemenperin</option>
                    <option value="unit_kementrian_lembaga">Unit Kementrian/Lembaga (Non-Kemenperin)</option>
                    <option value="unit_industri">Unit Industri</option>
                    <option value="unit_pemerintah_daerah">Unit Pemerintah Daerah</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="unit_kemenperin">Pilih unit pendidikan kemenperin</label>
                <select name="unit_kemenperin" id="unit_kemenperin" class="form-control">

                </select>
            </div>

            <div class="form-group mt-3 d-none">
                <label for="custom_unit">Nama Institusi anda</label>
                <input type="text" class="form-control" name="custom_unit" id="custom_unit">
            </div>

            <div class="form-group mt-3 d-none">
                <label for="province">Province</label>
                <select name="province" id="province" class="form-control">
                    @foreach ($provinces as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
             
            <div class="form-group mt-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="d-grid gap-2 mt-4 mb-3">
                <button type="submit" class="btn btn-primary btn-lg">
                    Daftar
                </button>
            </div>
            <a href="{{ url('/accounts/register') }}" class="mt-4">
                Sudah punya akun? Masuk disini
            </a>
        </form>
    </div>
</div>
@endsection

@section('javascript')
<script>
    function renderUnitKemenperin()
    {
        let jenisInstitusi = $('#jenis_institusi');
        let unitKemenperin = $('#unit_kemenperin');
        if(jenisInstitusi.val() == 'unit_kemenperin'){
            $.ajax({
                type: "get",
                url: "https://siva.kemenperin.go.id/api/v1/pro_vokasi/master_data/unit_pendidikan_kemenperin",
                success: function (response) {
                    if (response.status == 'OK') {
                        let datas = response.results;
                        let htmlOptions = '';
                        $.each(datas, function (indexInArray, valueOfElement) { 
                            htmlOptions += `
                                <option value="${valueOfElement.id}">${valueOfElement.name}</option>
                            `;
                        });
                        unitKemenperin.html(htmlOptions);
                        unitKemenperin.closest('.form-group').removeClass('d-none');
                    } else {
                        notie.alert({
                            type: 'error',
                            text: 'Cek koneksi internet anda!',
                            stay: false,
                            time: 3,
                            position: 'top'
                        })
                    }
                }
            });
        }else{
            unitKemenperin.closest('.form-group').addClass('d-none');
        }
    }
    renderUnitKemenperin();
    $('#jenis_institusi').change(function (e) { 
        e.preventDefault();
        if ($(this).val() == 'unit_kemenperin') {
            $('#custom_unit').closest('.form-group').addClass('d-none');
            $('#province').closest('.form-group').addClass('d-none');
            renderUnitKemenperin();
        } else {
            $('#unit_kemenperin').closest('.form-group').addClass('d-none');
            $('#custom_unit').closest('.form-group').removeClass('d-none');
            $('#province').closest('.form-group').removeClass('d-none');
        }
    });
    $('#form-register').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function (response) {
                if (response.status == 'OK') {
                    notie.alert({
                        type: 'success',
                        text: 'Akun anda berhasil dibuat, anda akan diarahkan ke halaman masuk/login!',
                        stay: false,
                        time: 3,
                        position: 'top'
                    })
                    setTimeout(() => {
                        window.location = '/accounts/login';
                    }, 3000);
                } else {
                    localStorage.clear();
                }
            }
        });
    });
</script>
@endsection