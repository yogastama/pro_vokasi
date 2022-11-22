@extends('home.layout', [
'menu' => 'account'
])

@section('content')
<div class="row" style="margin-top: 140px;margin-left:0px;margin-right:0px">
    <div class="col-12 px-4">
        <h2>
            Perbarui password Anda
        </h2>
    </div>
    <div class="col-12 px-4 mt-4">
        <form action="{{ route('accounts.update_password', ['token' => $token]) }}" method="POST" id="form-login">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="form-group">
                <label for="konfirmasi_password">Konfirmasi Password</label>
                <input type="password" class="form-control" name="konfirmasi_password">
            </div>
            <div class="d-grid gap-2 mt-4 mb-3">
                <button type="submit" class="btn btn-primary btn-lg">
                    Perbarui password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('javascript')

@endsection