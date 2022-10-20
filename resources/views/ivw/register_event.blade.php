@extends('ivw.layouts.layout')

@section('content')
<div class="container" style="margin-bottom:50px !important;margin-top:30px !important;">
    <h2>Registrasi Pro-Vokasi</h2>
    <p class="text-light">
        Event : {{ $event->title }}
    </p>
    <hr style="background: #ffffff">
    <form name="fr1" method="POST" action="">
        <span class="field">
            Nama Perusahaan <span style="color:red;">*</span>
        </span>
        <span class="content">
            <input type="text" class="isian" name="company" id="company">
        </span>
        <div style="clear:both"></div>

        <span class="field">
            Nama Peserta <span style="color:red;">*</span>
        </span>
        <span class="content">
            <input type="text" class="isian" name="member" id="member">
        </span>
        <div style="clear:both"></div>

        <span class="field">
            Jabatan <span style="color:red;">*</span>
        </span>
        <span class="content">
            <input type="text" class="isian" name="title" id="title">
        </span>
        <div style="clear:both"></div>

        <span class="field">
            Alamat Email <span style="color:red;">*</span>
        </span>
        <span class="content">
            <input type="text" class="isian" name="email" id="email">
        </span>
        <div style="clear:both"></div>

        <span class="field">
            Nomor Handphone (Whatsapp) <span style="color:red;">*</span>
        </span>
        <span class="content">
            <input type="text" class="isian" name="handphone" id="handphone">
        </span>
        <div style="clear:both"></div>

        <span class="field">
            ID Zoom <span style="color:red;">*</span>
        </span>
        <span class="content">
            <input type="text" class="isian" name="zoom" id="zoom">
        </span>
        <div style="clear:both"></div>
    
        <span style="color:red;">*</span> <span style="color:#ffffff;font-size:11px;">Wajib diisi</span>
        <div style="clear:both"></div>

        <span class="field nofield">&nbsp;</span>
        <span class="content">
            <input type='hidden' name='q' value=>
            <input type="submit" class="buttonreg register" value="Submit"
                style="border:0px solid;background-color:red;color:#ffffff !important;">
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
