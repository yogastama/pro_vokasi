@extends('ivw.layouts.layout')

@section('content')
<div class="container" style="margin-bottom:50px !important;margin-top:30px !important;">
    <h2>Lupa password</h2>
    <hr style="background: #ffffff">
    <form action="{{ route('accounts.process_forget_password') }}" method="POST" id="form-login">
        @csrf
        @method('POST')
        <span class="field">
            Email <span style="color:red;">*</span>
        </span>
        <span class="content">
            <input type="email" class="isian" name="email" id="email">
        </span>
        <div style="clear:both"></div>

        <span class="field nofield">&nbsp;</span>
        <span class="content">
            <input type='hidden' name='q' value=>
            <button type="submit" class="buttonreg register" value="Submit" style="border:0px solid;background-color:red;color:#ffffff !important;">
                Kirim link reset
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