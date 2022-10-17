@extends('home.layout', [
    'menu' => 'home'
])

@section('content')
<div class="row" style="margin-top: 130px;margin-left:0px;margin-right:0px;padding-bottom: 100px;">
    <div class="col-12 px-4">
        <h4>
            {{ $provokasi->name }}
        </h4>
        <hr>
    </div>
    <div class="row mt-3">
        <div class="col-12 px-4">
            <div class="row">
                <div class="col-12">
                    @if ($provokasi->youtube_video)
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe width="100%" class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $provokasi->youtube_video  }}" allowfullscreen></iframe>
                    </div>
                    @else
                        <img src="{{ url('/storage/' . $provokasi->banner) }}" alt="" width="100%">
                    @endif
                </div>
                <div class="col-12 mt-3">
                    <hr>
                    <div class="d-grid gap-2">
                        <a href="{{ $provokasi->link }}" class="btn btn-dark btn-lg" target="_blank">
                            Visit
                        </a>
                    </div>
                    <hr>
                    {!! $provokasi->content !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection