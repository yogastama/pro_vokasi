@extends('ivw.layouts.layout')

@section('content')
<div class="container" style="margin-bottom:50px !important;margin-top:30px !important;">
    <h2>Login Pro-Vokasi</h2>
    <hr style="background: #ffffff">
    <form action="{{ route('accounts.process_login') }}" method="POST" id="form-login">
        <span class="field">
            Email <span style="color:red;">*</span>
        </span>
        <span class="content">
            <input type="email" class="isian" name="username" id="username">
        </span>
        <div style="clear:both"></div>

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
            <button type="submit" class="buttonreg register" value="Submit" style="border:0px solid;background-color:red;color:#ffffff !important;">
                Masuk
            </button>
        </span>


        <div style="clear:both"></div>
        {{-- <div style="width:100%;color:#ffffff;line-height:11px;font-size:11px;margin-top:20px;margin-bottom:20px;">
            Dengan mengisi kolom registrasi ini, Anda tidak berkeberatan data Anda digunakan untuk kepentingan
            kegiatan Industrial Vocational Week 2022 & Industrial Vocational Year 2023 dan program lainnya. Data tidak disalahgunakan dan tidak untuk
            kepentingan komersial.
        </div> --}}

    </form>
</div>
@endsection

@section('javascript')
<script>
    $('#form-login').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(response) {
                if (response.status == 'OK') {
                    localStorage.setItem("email_siva", response.results.user.email);
                    localStorage.setItem("username_siva", response.results.user.username);
                    localStorage.setItem("name_siva", response.results.user.name);
                    localStorage.setItem("token_siva", response.results.token);
                    localStorage.setItem("institution_siva", response.results.user.institution);
                    notie.alert({
                        type: 'success',
                        text: 'Login berhasil!',
                        stay: false,
                        time: 10,
                        position: 'top'
                    })
                    setTimeout(() => {
                        window.location = '/';
                    }, 1000);
                } else {
                    localStorage.clear();
                }
            },
            error: function(response) {
                $.each(response.responseJSON.error_messages, function(indexInArray, valueOfElement) {
                    notie.alert({
                        type: 'error',
                        text: valueOfElement,
                        stay: false,
                        time: 10,
                        position: 'top'
                    })
                });
            }
        });
    });
</script>
@endsection