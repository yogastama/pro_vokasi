@extends('home.layout', [
'menu' => 'account'
])

@section('content')
<div class="row" style="margin-top: 140px;margin-left:0px;margin-right:0px">
    <div class="col-12 px-4">
        <h2>
            Reset password
        </h2>
    </div>
    <div class="col-12 px-4 mt-4">
        <form action="{{ route('accounts.process_forget_password') }}" method="POST" id="form-login">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="username">Email</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="d-grid gap-2 mt-4 mb-3">
                <button type="submit" class="btn btn-primary btn-lg">
                    Kirim link reset password
                </button>
            </div>
            <a href="{{ url('/accounts/register') }}" class="mt-4">
                Belum punya akun? Daftar sini
            </a>
            <br><br>
            <a href="{{ url('/accounts/login') }}" class="mt-4">
                Sudah punya akun? Masuk disini
            </a>
        </form>
    </div>
</div>
@endsection

@section('javascript')

@endsection