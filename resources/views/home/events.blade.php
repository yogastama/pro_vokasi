@extends('home.layout', [
    'menu' => 'events'
])


@section('content')
<div class="row" style="margin-top: 130px;margin-left:0px;margin-right:0px;padding-bottom: 100px;">
    <div class="col-12 px-4">
        <b>
            EVENT TERSEDIA
        </b>
    </div>
    <div class="row mt-3">
        <div class="col-10 ps-4">
            <form action="{{ route('event.index') }}" method="GET">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Cari event..." name="search" value="{{ request()->get('search') }}">
                </div>
                @if (request()->get('search'))
                    <small class="text-muted">Hasil pencarian "{{ request()->get('search') }}" ditemukan {{ count($events) }} event</small>
                @endif
            </form>
        </div>
        <div class="col-2 pe-4">
            <div class="d-grid gap-2">
                <div class="btn btn-primary">
                    <i class="fa-solid fa-search"></i>
                </div>
            </div>
        </div>
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
                                    <div class="badge text-bg-info" style="font-size: 10px">
                                        {{ ucwords($event->category_event->title) }}
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