@extends('home.layout', [
    'menu' => 'events'
])

@section('content')
<div class="row" style="margin-top: 120px;margin-left:0px;margin-right:0px;padding-bottom: 100px;">
    <div class="col-12 px-4">
        <h3>
            {{ $event->title }}
        </h3>
        <hr>
    </div>
    <div class="row mt-3">
        <div class="col-12 px-4">
            <div class="row">
                <div class="col-12">
                    <img src="{{ url('/storage/' . $event->banner) }}" alt="" width="100%">
                </div>
                <div class="col-12">
                    <hr>
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
                    <div class="d-grid gap-2 mt-3">
                        <a href="{{ route('event.register', ['id' => $event->id]) }}" class="btn btn-primary btn-lg">
                            Daftar
                        </a>
                    </div>
                    <hr>
                    {!! $event->content !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection