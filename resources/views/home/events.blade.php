@extends('home.layout', [
    'menu' => 'events'
])

@section('content')
<div class="row" style="margin-top: 80px;margin-left:0px;margin-right:0px;padding-bottom: 100px;">
    <div class="col-12 px-4">
        <b>
            EVENT TERSEDIA
        </b>
    </div>
    <div class="row mt-3">
        <div class="col-12 px-4">
            <div class="row">
                @foreach ($events as $event)
                <div class="col-12 mt-3">
                    <a href="{{ route('event.show', ['id' => $event->id]) }}" class="text-decoration-none">
                        <div class="service-icon">
                            <div class="row">
                                <div class="col-4">
                                    <img src="{{ url('/storage/' . $event->banner) }}" alt="" width="100%">
                                </div>
                                <div class="col-8 text-dark">
                                    <b style="font-size: 14px;">
                                        {{ $event->title }}
                                    </b>
                                    <hr>
                                    <span style="font-size: 12px">
                                        <i class="fa-solid fa-calendar"></i> {{ date('d M Y H:i', strtotime($event->start_event)) }} - {{ date('d M Y H:i', strtotime($event->close_event)) }}
                                    </span>
                                    <div class="badge text-bg-warning" style="font-size: 10px">
                                        {{ ucwords($event->type_event) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection