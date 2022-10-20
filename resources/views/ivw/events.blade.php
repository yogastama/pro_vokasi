@extends('ivw.layouts.layout')

@section('content')
<div class="container">
    <div class="main" style="padding:0px;margin:50px auto;width:100%;border:0px solid red;">
        <h2>Event Kemenperin</h2>
        <div class="slider slider-nav">
            @foreach ($events as $item)
            <div class="in_thumbnail">
                <a href="{{ route('ivw.event.show', ['id' => $item->id]) }}">
                    <img id="img_1" src="{{ url('/storage/') . '/' . $item->banner }}" style="width:100%;">
                </a>
                <div id="title_1" class="title" onclick="document.getElementById('id0{{ $loop->iteration }}').style.display='block'">
                    <span class="in_title">
                        {{ $item->title }}
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