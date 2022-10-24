<!DOCTYPE html>
<html lang="en">

<head>
    @include('ivw.head')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/notie/dist/notie.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
    @include('ivw.layouts.header')

    @yield('content')

    <div style="clear:both"></div>

    @include('ivw.layouts.script')

    <div style="clear:both"></div>

    <div style="width:100%;color:#ffffff;text-align: center;font-size:12px;padding:1% 5% 1% 5%;">
        Kementerian Perindustrian : BPSDMI<br>
        Jl. Widya Chandra VIII No.34, RT.3/RW.1, Senayan, Kec. Kby. Baru, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12950
    </div>
    <div style="width:100%;color:#ffffff;text-align: center;font-size:12px;padding:1% 5% 1% 5%;"><br>
        Copyright &copy; 2021
    </div>

    <div style="clear:both"></div>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield('javascript')
    <script src="https://unpkg.com/notie"></script>
    <script>
        @if(Session::get('alert-type'))
        notie.alert({
            type: `{{ Session::get('alert-type') }}`,
            text: `{{ Session::get('message') }}`,
            stay: false,
            time: 3,
            position: 'top'
        })
        @endif
        if(localStorage.getItem('token_siva')){
            $('.subheader').html(`
            <a href="{{ route('ivw.accounts') }}"
                style="text-decoration:none;"><span class="buttonreg"><img src="{{ url('ivw/red-ball.png') }}"
                        style="width:20px;margin-top:-3px;">Akun saya</span></a>
            `);
        }else{
            if($('#modal-register-login').length){
                const modalRegisterLogin = new bootstrap.Modal('#modal-register-login')
                modalRegisterLogin.show();
            }
        }
        
    </script>
</body>

</html>
