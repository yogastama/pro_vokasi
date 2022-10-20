<!DOCTYPE html>
<html lang="en">

<head>
    @include('ivw.head')
</head>

<body>

    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Registrasi Pro-Vokasi</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form name="fr2" method="POST" action="">
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

                        <span class="field">
                            Pilih Pro-Vokasi dengan topik: <span style="color:red;">*</span>
                        </span>
                        <span class="content" style="height:auto !important;">
                            <label><input type="checkbox" name="topic[]"
                                    value="Coaching Clinic Super Tax Deduction Kegiatan Vokasi"> Coaching Clinic Super
                                Tax Deduction Kegiatan Vokasi</label><br>
                            <label><input type="checkbox" name="topic[]"
                                    value="Pelatihan Cost and Benefit Analysis/Analisa Biaya dan Manfaat"> Pelatihan
                                Cost and Benefit Analysis/Analisa Biaya dan Manfaat</label><br>
                            <label><input type="checkbox" name="topic[]"
                                    value="Pelatihan In-Company Trainer/Pelatih Tempat Kerja"> Pelatihan In-Company
                                Trainer/Pelatih Tempat Kerja</label><br>
                            <label><input type="checkbox" name="topic[]" value="Program Perbaikan Kemitraan"> Program
                                Perbaikan Kemitraan</label><br>
                            <label><input type="checkbox" name="topic[]" value="Link and Match Meter"> Link and Match
                                Meter</label>
                        </span>
                        <div style="clear:both"></div>

                        <span style="color:red;">*</span> <span style="color:#ffffff;font-size:10px;">Wajib diisi</span>
                        <div style="clear:both"></div>

                        <span class="field nofield">&nbsp;</span>
                        <span class="content">
                            <input type='hidden' name='q'
                                value='<?php echo sha1(date("Y-m-d H:i:s").'CoachingClinic21'.time()); ?>'>
                            <input type="submit" class="buttonreg register" value="Submit"
                                style="border:0px solid;background-color:red;color:#ffffff !important;">
                        </span>


                        <div style="clear:both"></div>
                        <div
                            style="width:100%;color:#ffffff;line-height:11px;font-size:10px;margin-top:20px;margin-bottom:20px;">
                            Dengan mengisi kolom registrasi ini, Anda tidak berkeberatan data Anda digunakan untuk
                            kepentingan kegiatan Industrial Vocational Week dan program lainnya. Data tidak
                            disalahgunakan dan tidak untuk kepentingan komersial.
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('ivw.layouts.header')

    @yield('content')

    <div style="clear:both"></div>

    @include('ivw.layouts.script')

    <div style="clear:both"></div>

    <div style="width:100%;color:#ffffff;text-align: center;font-size:12px;padding:1% 5% 1% 5%;">
        Kementerian Perindustrian Republik Indonesia<br>
        copyright &copy; 2021
    </div>

    <div style="clear:both"></div>

</body>

</html>
