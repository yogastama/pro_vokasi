@extends('ivw.layouts.layout')

@section('content')
<div class="container" style="margin-bottom:50px !important;margin-top:30px !important;">
    <h2>Sukses pendaftaran!</h2>
    <p class="text-light">
        Event : {{ $event->title }}
    </p>
    <hr style="background: #fff;">
    <div class="alert alert-success">
        Silakan baca instruksi dibawah ini.
    </div>
    <div class="row">
        <div class="col-12 mt-2 text-light">
            <b>SIMPAN KE KALENDER ANDA.</b>
        </div>
        <div class="col-4 mt-3">
            <div class="d-grid gap-2">
                <a target="_blank" href="{{ $google_calendar }}" class="btn btn-light">
                    <img src="{{ url('/images/others/google_calendar.png') }}" alt="google calendar" width="20px"> Google Calendar
                </a>
            </div>
        </div>
        <div class="col-4 mt-3">
            <div class="d-grid gap-2">
                <a target="_blank" href="{{ $yahoo_calendar }}" class="btn btn-light">
                    <img src="{{ url('/images/others/yahoo_calendar.png') }}" alt="yahoo calendar" width="20px"> Yahoo Calendar
                </a>
            </div>
        </div>
        <div class="col-4 mt-3">
            <div class="d-grid gap-2">
                <a target="_blank" href="{{ $web_outlook }}" class="btn btn-light">
                    <img src="{{ url('/images/others/outlook.png') }}" alt="outlook calendar" width="20px"> Outlook Calendar
                </a>
            </div>
        </div>
        <div class="col-12 text-light mt-2">
            <hr>
            <b>INSTRUKSI.</b>
        </div>
        <div class="col-12 mt-2 text-light">
            {!! $response_event->content ?? '' !!}
        </div>
    </div>
</div>
@endsection

@section('javascript')

@endsection
