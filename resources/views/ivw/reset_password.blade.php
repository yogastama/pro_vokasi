@extends('ivw.layouts.layout')

@section('content')
<div class="container" style="margin-bottom:50px !important;margin-top:30px !important;">
    <h2>Reset password</h2>
    <hr style="background: #ffffff">
    <form action="{{ route('accounts.update_password', ['token' => $token]) }}" method="POST" id="form-login">
        @csrf
        @method('POST')
        
        <span class="field">
            Password Baru <span style="color:red;">*</span>
        </span>
        <span class="content">
            <input type="password" class="isian" name="password" id="password">
        </span>
        <div style="clear:both"></div>


        <span class="field">
            Konfirmasi Password Baru <span style="color:red;">*</span>
        </span>
        <span class="content">
            <input type="password" class="isian" name="konfirmasi_password" id="password">
        </span>
        <div style="clear:both"></div>

        <span class="field nofield">&nbsp;</span>
        <span class="content">
            <input type='hidden' name='q' value=>
            <button type="submit" class="buttonreg register" value="Submit" style="border:0px solid;background-color:red;color:#ffffff !important;">
                Perbarui password
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
    
</script>
@endsection