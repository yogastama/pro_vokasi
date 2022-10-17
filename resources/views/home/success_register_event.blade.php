@extends('home.layout', [
'menu' => 'events'
])

@section('content')
<div class="row" style="margin-top: 120px;margin-left:0px;margin-right:0px;padding-bottom: 100px;">
    <div class="col-12 px-4">
        <h3>
            Sukses pendaftaran!
        </h3>
        <small class="text-muted">{{ $event->title }}</small>
        <hr>
    </div>
    <div class="row mt-3">
        <div class="col-12 px-4">
            <div class="row">
                <div class="col-12 mt-2">
                    <div class="alert alert-success">
                        Silakan baca instruksi dibawah ini.
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <b>SIMPAN KE KALENDER ANDA.</b>
                </div>
                <div class="col-4 mt-3">
                    <div class="d-grid gap-2">
                        <a target="_blank" href="{{ $google_calendar }}" class="btn btn-outline-dark">
                            <img src="{{ url('/images/others/google_calendar.png') }}" alt="google calendar" width="20px"> Google Calendar
                        </a>
                    </div>
                </div>
                <div class="col-4 mt-3">
                    <div class="d-grid gap-2">
                        <a target="_blank" href="{{ $yahoo_calendar }}" class="btn btn-outline-dark">
                            <img src="{{ url('/images/others/yahoo_calendar.png') }}" alt="yahoo calendar" width="20px"> Yahoo Calendar
                        </a>
                    </div>
                </div>
                <div class="col-4 mt-3">
                    <div class="d-grid gap-2">
                        <a target="_blank" href="{{ $web_outlook }}" class="btn btn-outline-dark">
                            <img src="{{ url('/images/others/outlook.png') }}" alt="outlook calendar" width="20px"> Outlook Calendar
                        </a>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <hr>
                    <b>INSTRUKSI.</b>
                </div>
                <div class="col-12 mt-2">
                    {!! $response_event->content !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')

@endsection