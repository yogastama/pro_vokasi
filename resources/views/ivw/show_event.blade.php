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
        <div class="mt-2">
            <i class="fa-solid fa-calendar"></i> Registration Start Date
        </div>
        <small class="text-muted">
            {{ date('d M Y H:i', strtotime($event->start_register_event)) }} - {{ date('d M Y H:i', strtotime($event->end_register_event)) }}
        </small>
        <br>
        @if($event->start_register_event > date('Y-m-d H:i:s'))
            <div class="alert alert-info text-center mt-2">
                Coming soon...
            </div>
        @else
            @if($event->start_register_event < date('Y-m-d H:i:s') && $event->end_register_event > date('Y-m-d H:i:s'))
                <div class="btn-wrapper-register">
                    <a href="{{ route('ivw.event.register', ['id' => $event->id]) }}" class="btn btn-primary btn-block btn-lg mt-4 mb-4">
                        Daftar
                    </a>
                </div>
            @else
                <div class="alert alert-info text-center mt-2">
                    Pendaftaran ditutup
                </div>
            @endif
        @endif
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

@section('javascript')
    
<script>
    function isRegisterEvent()
    {
        $.ajax({
            type: "post",
            url: "{{ route('event.is_register_event') }}",
            data: {
                event_id : '{{ $event->id }}',
                email : localStorage.getItem('email_siva')
            },
            success: function (response) {
                if (response.results) {
                    $('.btn-wrapper-register').html(`
                        <a href="{{ url('/') }}/desktop/success_register_event/${response.results.event_id}/${response.results.id}" class="btn btn-dark btn-lg btn-block mt-4 mb-4">
                            Lihat detail pendaftaran saya
                        </a>
                    `);
                } else {
                    
                }
            }
        });
    }
    isRegisterEvent();
</script>
@endsection
