@extends('ivw.layouts.layout')

@section('content')
<div class="container">
    <div class="kiri">
        <h2>
            {{ $provokasi->name }}
        </h2>


        <div style="clear:both"></div>
        <br>
        {!! $provokasi->content !!}
        <br>
        <a href="{{ $provokasi->link }}" class="btn btn-danger btn-block btn-lg mt-3" target="_blank">
            Visit
        </a>
    </div>
    <div class="kanan">
        @if ($provokasi->youtube_video)
        <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{ $provokasi->youtube_video }}?controls=0"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
        @else
        <img src="{{ url('/storage/') . '/' . $provokasi->banner }}" alt="banner" width="100%">
        @endif
    </div>
</div>
<div style="clear:both"></div>

<div class="container">
    <div class="main" style="padding:0px;margin:0 auto;width:100%;border:0px solid red;">
        <h2>Program Kemenperin <span style="font-weight:normal">Lainnya</span></h2>
        <div class="slider slider-nav">
            @foreach ($provokasis as $item)
            <div class="in_thumbnail">
                <a href="{{ route('ivw.show', ['id' => $item->id]) }}">
                    <img id="img_1" src="{{ url('/storage/') . '/' . $item->banner }}" style="width:100%;">
                </a>
                <div id="title_1" class="title"
                    onclick="document.getElementById('id0{{ $loop->iteration }}').style.display='block'">
                    <span class="in_title">
                        {{ $item->name }}
                    </span>
                    <span class="play">
                        <img src="{{ url('ivw/play.png') }}" style="width:100%;"
                            onclick="document.getElementById('id0{{ $loop->iteration }}').style.display='block'">
                    </span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
