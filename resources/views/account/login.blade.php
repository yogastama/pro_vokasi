@extends('home.layout', [
'menu' => 'account'
])

@section('content')
<div class="row" style="margin-top: 140px;margin-left:0px;margin-right:0px">
    <div class="col-12 px-4">
        <h2>
            Masuk
        </h2>
    </div>
    <div class="col-12 px-4 mt-4">
        <form action="{{ route('accounts.process_login') }}" method="POST" id="form-login">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="username">Email</label>
                <input type="email" class="form-control" name="username">
            </div>
            <div class="form-group mt-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="d-grid gap-2 mt-4 mb-3">
                <button type="submit" class="btn btn-primary btn-lg">
                    Masuk
                </button>
            </div>
            <a href="{{ url('/accounts/register') }}" class="mt-4">
                Belum punya akun? Daftar sini
            </a>
        </form>
    </div>
</div>
@endsection

@section('javascript')
    <script>
        $('#form-login').submit(function (e) { 
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function (response) {
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
                        $.each(response.responseJSON.error_messages, function (indexInArray, valueOfElement) { 
                            notie.alert({
                                type: 'error',
                                text: valueOfElement,
                                stay: false,
                                time: 10,
                                position: 'top'
                            })
                        });
                    }
                },
                error: function (response){
                    $.each(response.responseJSON.error_messages, function (indexInArray, valueOfElement) {
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