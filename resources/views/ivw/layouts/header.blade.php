<div class="header">
    <a href="/" style="text-decoration:none;color:red;">
        <div style="width:auto;float:left;" class="header_kiri">
            <img src="{{ url('/images/logo/logo3.png') }}" alt="logo" width="60px">
        </div>
        <div style="font-weight: normal;color:#000000;float:left;" class="header_kanan">Industrial Vocational Week 2022 & Industrial Vocational Year 2023
        </div>
        <div class="header_kanan2">
            <a href="https://www.giz.de/en/worldwide/352.html" target="_blank">
                <div class="column" style="width:auto;float:left;"><img src="{{ url('ivw/logo-giz.jpg') }}" class="gbr"
                        style="height:50px" alt=""></div>
            </a>
            <a href="https://www.ekon.go.id/" target="_blank">
                <div class="column" style="width:auto;float:left;"><img src="{{ url('ivw/logo-kemenko2.png') }}"
                        class="gbr" style="height:50px" alt=""></div>
            </a>
            <a href="https://www.kemenperin.go.id/" target="_blank">
                <div class="column" style="width:auto;float:left;"><img src="{{ url('ivw/logo-kemenperin.png') }}"
                        class="gbr" style="height:50px" alt=""></div>
            </a>
            <a href="https://kadin.id/" target="_blank">
                <div class="column" style="width:auto;float:left;"><img src="{{ url('ivw/logo-kadin2.png') }}"
                        class="gbr" style="height:50px" alt=""></div>
            </a>
        </div>
    </a>
</div>
<div class="subheader">
    {{-- <a href="{{ route('ivw.events') }}"
    style="text-decoration:none;"><span class="buttonreg"><img src="{{ url('ivw/red-ball.png') }}"
            style="width:20px;margin-top:-3px;"> Event Kemenperin</span></a> --}}
    <a class="btn btn-light" href="{{ route('ivw.register') }}" style="text-decoration:none;"><span class="buttonreg"><img
                src="{{ url('ivw/red-ball.png') }}" style="width:20px;margin-top:-3px;"> Registrasi Akun</span></a>
    <a class="btn btn-light" href="{{ route('ivw.login') }}" style="text-decoration:none;"><span class="buttonreg"><img
                src="{{ url('ivw/red-ball.png') }}" style="width:20px;margin-top:-3px;"> Login Akun</span></a>
</div>
