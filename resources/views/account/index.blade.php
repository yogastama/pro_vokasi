@extends('home.layout', [
'menu' => 'account'
])

@section('content')
<div class="row" style="margin-top: 140px;margin-left:0px;margin-right:0px">
    <div class="col-12 px-4">
        <h2>
            Akun
        </h2>
    </div>
    <div class="col-12 px-4 mt-4">
        <img src="{{ url('/images/icons/user.svg') }}" alt="user" width="100px">
    </div>
    <div class="col-12">
        <hr>
        {{-- <a href="" class="btn btn-warning">
            Edit
        </a> --}}
        <table class="table table-bordered mt-3">
            <tr>
                <th>
                    Name
                </th>
                <td class="account-name">
                    
                </td>
            </tr>
            <tr>
                <th>
                    E-Mail
                </th>
                <td class="account-email">

                </td>
            </tr>
            <tr>
                <th>
                    Username
                </th>
                <td class="account-username">

                </td>
            </tr>
            <tr>
                <th>
                    Institution
                </th>
                <td class="account-institution">

                </td>
            </tr>
        </table>
        <div class="d-grid gap-2">
            <div class="btn btn-logout btn-danger">
                Logout
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    $('.account-name').html(localStorage.getItem('name_siva'));
    $('.account-email').html(localStorage.getItem('email_siva'));
    $('.account-username').html(localStorage.getItem('username_siva'));
    $('.account-institution').html(localStorage.getItem('institution_siva'));

    $('.btn-logout').click(function (e) { 
        e.preventDefault();
        if(confirm('Apakah anda yakin?')){
            window.location = '/';
            localStorage.clear();
        }
    });
</script>
@endsection