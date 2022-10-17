<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pro-Vokasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    @laravelPWA
    <link rel="stylesheet" href="{{ url('/styles/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/notie/dist/notie.min.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-4 p-0">
                <div class="wrapper-content">
                    <nav class="fixed-top">
                        <div class="container-fluid">
                            <div class="row justify-content-center">
                                <div class="col-12 col-sm-4">
                                    <div class="navbar-app">
                                        <div class="row">
                                            <div class="col-12 text-center font-inter title-app">
                                                PRO-VOKASI APP
                                            </div>
                                            <div class="col-12 mt-2">
                                                <img src="{{ url('/images/others/kerjasama.png') }}" alt="kerjasama" width="100%" class="rounded">
                                            </div>
                                            @yield('content_navbar_top')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                    @yield('content')
                    <div class="fixed-bottom">
                        <div class="row justify-content-center">
                            <div class="col-12 col-sm-4">
                                <div class="navbar-bottom-app">
                                    <div class="row">
                                        <div class="col-4 py-1 text-center link-navbar-bottom {{ $menu == 'home' ? 'active' : ''  }}">
                                            <a href="{{ url('/') }}">
                                                <img src="{{ url('/icons/home.svg') }}" alt="home" width="20px">
                                                <div style="font-size: 14px">
                                                    Home
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-4 py-1 text-center link-navbar-bottom {{ $menu == 'events' ? 'active' : ''  }}">
                                            <a href="{{ url('/events') }}">
                                                <img src="{{ url('/icons/event.svg') }}" alt="home" width="20px">
                                                <div style="font-size: 14px">
                                                    Events
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-4 py-1 text-center link-navbar-bottom {{ $menu == 'account' ? 'active' : ''  }}">
                                            <a href="{{ url('/accounts/login') }}" class="account-menu">
                                                <img src="{{ url('/icons/person.svg') }}" alt="home" width="20px">
                                                <div style="font-size: 14px">
                                                    Account
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>  <script src="https://unpkg.com/notie"></script>
    <script src="https://unpkg.com/notie"></script>
    <script>
        if (localStorage.getItem('token_siva')) {
            $('.account-menu').attr('href', `{{ url('/accounts') }}`);
        } else {
            $('.account-menu').attr('href', `{{ url('/accounts/login') }}`);
        }
        @if(Session::get('alert-type'))
        notie.alert({
            type: `{{ Session::get('alert-type') }}`,
            text: `{{ Session::get('message') }}`,
            stay: false,
            time: 3,
            position: 'top'
        })
        @endif
    </script>
    @yield('javascript')
</body>

</html>
