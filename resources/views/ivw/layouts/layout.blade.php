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

    <div class="modal fade" id="modal-register-login" tabindex="-1" aria-labelledby="modal-register-loginLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-light">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-light" id="modal-register-loginLabel">Akun</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        Kamu belum login, silakan daftar atau login dibawah ini.
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="d-grid gap-2 mt-3">
                                <a href="{{ url('/desktop/register') }}" class="btn btn-danger btn-lg">
                                    Daftar Akun
                                </a>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-grid gap-2 mt-3">
                                <a href="{{ url('/desktop/login') }}" class="btn btn-outline-danger btn-lg">
                                    Login Akun
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
            const modalRegisterLogin = new bootstrap.Modal('#modal-register-login')
            modalRegisterLogin.show();
        }
        
    </script>
</body>

</html>
