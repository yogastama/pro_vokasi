@extends('ivw.layouts.layout')

@section('content')
<div class="container">
    <div class="kiri">
        <h2>
            {{ $event->title }}
        </h2>


        <div style="clear:both"></div>
        <div>
            <i class="fa-solid fa-calendar"></i> Time
        </div>
        <small class="text-muted">
            {{ date('d M Y H:i', strtotime($event->start_event)) }} - {{ date('d M Y H:i', strtotime($event->close_event)) }}
        </small>
        <br>
        <div class="mt-2">
            <i class="fa-solid fa-bookmark"></i> Category
        </div>
        <small class="text-muted">{{ $event->category_event->title }}</small>
        <br>
        <div class="mt-2">
            <i class="fa-solid fa-location-pin"></i> Event Type
        </div>
        <small class="text-muted"><span class="badge text-bg-warning">{{ ucwords($event->type_event) }}</span></small>
        <br>
        <a href="{{ route('ivw.event.register', ['id' => $event->id]) }}" class="btn btn-primary btn-block btn-lg mt-4 mb-4">
            Daftar
        </a>
        <br>
        {!! $event->content !!}
    </div>
    <div class="kanan">
        @if ($event->youtube_video)
        <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{ $event->youtube_video }}?controls=0"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
        @else
        <img src="{{ url('/storage/') . '/' . $event->banner }}" alt="banner" width="100%">
        @endif
    </div>
</div>
@endsection
