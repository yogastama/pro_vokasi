@extends('ivw.layouts.layout')

@section('content')
<div class="container" style="margin-bottom:50px !important;margin-top:30px !important;">
    <h2>Register Pro-Vokasi</h2>
    <hr style="background: #ffffff">
    <form action="{{ route('accounts.process_register') }}" method="POST" id="form-register">
        @csrf
        @method('POST')
        <span class="field">
            Nama <span style="color:red;">*</span>
        </span>
        <span class="content">
            <input type="text" class="isian" name="name" id="name">
        </span>
        <div style="clear:both"></div>

        <span class="field">
            Email <span style="color:red;">*</span>
        </span>
        <span class="content">
            <input type="email" class="isian" name="email" id="email">
        </span>
        <div style="clear:both"></div>

        <span class="field">
            Username <span style="color:red;">*</span>
        </span>
        <span class="content">
            <input type="text" class="isian" name="username" id="username">
        </span>
        <div style="clear:both"></div>

        <span class="field">
            Jenis Institusi <span style="color:red;">*</span>
        </span>
        <span class="content">
            <select name="jenis_institusi" id="jenis_institusi" class="isian">
                <option value="unit_kemenperin">Unit Pendidikan Tinggi Kemenperin</option>
                <option value="unit_smk_kemenperin">Unit SMK Kemenperin</option>
                <option value="unit_kementrian_lembaga">Unit Kementrian/Lembaga (Non-Kemenperin)</option>
                <option value="unit_industri">Unit Industri</option>
                <option value="unit_pemerintah_daerah">Unit Pemerintah Daerah</option>
                <option value="lainnya">Lainnya</option>
            </select>
        </span>
        <div style="clear:both"></div>

        <div class="form-unit-kemenperin">
            <span class="field">
                Pilih unit pendidikan kemenperin <span style="color:red;">*</span>
            </span>
            <span class="content">
                <select name="unit_kemenperin" id="unit_kemenperin" class="isian">
                    
                </select>
            </span>
            <div style="clear:both"></div>
        </div>
        
        <div class="form-institusi-custom d-none">
            <span class="field">
                Nama Institusi Anda <span style="color:red;">*</span>
            </span>
            <span class="content">
                <input type="text" class="isian" name="custom_unit" id="custom_unit">
            </span>
            <div style="clear:both"></div>
        </div>

        <div class="form-province d-none">
            <span class="field">
                Province <span style="color:red;">*</span>
            </span>
            <span class="content">
                <select name="province" id="province" class="isian">
                    @foreach ($provinces as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </span>
            <div style="clear:both"></div>
        </div>

        <span class="field">
            Password <span style="color:red;">*</span>
        </span>
        <span class="content">
            <input type="password" class="isian" name="password" id="password">
        </span>
        <div style="clear:both"></div>

        <span class="field nofield">&nbsp;</span>
        <span class="content">
            <input type='hidden' name='q' value=>
            <button type="submit" class="buttonreg register" value="Submit"
                style="border:0px solid;background-color:red;color:#ffffff !important;">
                Masuk
            </button>
        </span>


        <div style="clear:both"></div>
        <div style="width:100%;color:#ffffff;line-height:11px;font-size:11px;margin-top:20px;margin-bottom:20px;">
            Dengan mengisi kolom registrasi ini, Anda tidak berkeberatan data Anda digunakan untuk kepentingan
            kegiatan Industrial Vocational Week dan program lainnya. Data tidak disalahgunakan dan tidak untuk
            kepentingan komersial.
        </div>

    </form>
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
                        unitKemenperin.closest('.form-unit-kemenperin').removeClass('d-none');
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
            unitKemenperin.closest('.form-unit-kemenperin').addClass('d-none');
        }
    }
    renderUnitKemenperin();
    $('#jenis_institusi').change(function (e) { 
        e.preventDefault();
        if ($(this).val() == 'unit_kemenperin') {
            $('#custom_unit').closest('.form-institusi-custom').addClass('d-none');
            $('#province').closest('.form-province').addClass('d-none');
            renderUnitKemenperin();
        } else {
            $('#unit_kemenperin').closest('.form-unit-kemenperin').addClass('d-none');
            $('#custom_unit').closest('.form-institusi-custom').removeClass('d-none');
            $('#province').closest('.form-province').removeClass('d-none');
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
                        window.location = '{{ url("/desktop/login") }}';
                    }, 3000);
                } else {
                    localStorage.clear();
                    if(response.responseJSON.error_messages){
                        $.each(response.responseJSON.error_messages, function (indexInArray, valueOfElement) { 
                            notie.alert({
                                type: 'error',
                                text: valueOfElement,
                                stay: false,
                                time: 3,
                                position: 'top'
                            })       
                        });
                    }
                }
            },
            error: function (response){
                $.each(response.responseJSON.error_messages, function (indexInArray, valueOfElement) {
                    notie.alert({
                        type: 'error',
                        text: valueOfElement,
                        stay: false,
                        time: 3,
                        position: 'top'
                    })
                });
            }
        });
    });

</script>
@endsection
