@extends('ivw.layouts.layout')

@section('content')
<div class="container" style="margin-bottom:50px !important;margin-top:30px !important;">
    <h2>Accounts</h2>
    <hr style="background: #ffffff">

    <div class="col-12">
        <hr>
        <table class="table table-bordered mt-3">
            <tr>
                <th class="text-light">
                    Name
                </th>
                <td class="account-name text-light">
                    
                </td>
            </tr>
            <tr>
                <th class="text-light">
                    E-Mail
                </th>
                <td class="account-email text-light">

                </td>
            </tr>
            <tr>
                <th class="text-light">
                    Username
                </th>
                <td class="account-username text-light">

                </td>
            </tr>
            <tr>
                <th class="text-light">
                    Institution
                </th>
                <td class="account-institution text-light">

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
