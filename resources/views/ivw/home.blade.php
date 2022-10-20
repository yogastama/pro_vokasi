@extends('ivw.layouts.layout')

@section('content')
<div class="container-lg my-0">
    <div id="myCarousel" class="carousel carousel-dark slide" data-bs-ride="carousel">

        <!-- Carousel indicators -->
        <ol class="carousel-indicators">
            @foreach ($sliders as $slider)
            <li data-bs-target="#myCarousel" data-bs-slide-to="{{ $loop->iteration - 1 }}" class="{{ $loop->iteration - 1 == 1 ? 'active' : '' }}"></li>
            @endforeach
        </ol>

        <!-- Wrapper for carousel items -->
        <div class="carousel-inner">
            @foreach ($sliders as $slider)
            <div class="carousel-item {{ $loop->iteration == 1 ? 'active' : '' }}">
                <div class="bor"
                    style="background-image: url('ivw/border.png') !important;z-index:0 !important; border:0px solid red;width: 100%;position: absolute;background-position: bottom center;background-size: 100%;background-repeat:no-repeat;">
                </div>
                <img src="{{ url('/storage/')  . '/'. $slider->image }}" class="d-block w-100 gbr_{{ $loop->iteration }}" alt="Slide 0">
                <div class="carousel-caption ">
                </div>
            </div>
            @endforeach
        </div>

        <!-- Carousel controls -->
        <a class="carousel-control-prev" href="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
</div>

<div style="clear:both"></div>

<div class="container">
    <div class="main" style="padding:0px;margin:0 auto;width:100%;border:0px solid red;">
        <h2>Program Kemenperin</h2>
        <div class="slider slider-nav">
            @foreach ($provokasi as $item)
            <div class="in_thumbnail">
                <a href="{{ route('ivw.show', ['id' => $item->id]) }}">
                    <img id="img_1" src="{{ url('/storage/') . '/' . $item->banner }}" style="width:100%;">
                </a>
                <div id="title_1" class="title" onclick="document.getElementById('id0{{ $loop->iteration }}').style.display='block'">
                    <span class="in_title">
                        {{ $item->name }}
                    </span>
                    <span class="play">
                        <img src="ivw/play.png" style="width:100%;"
                            onclick="document.getElementById('id0{{ $loop->iteration }}').style.display='block'">
                    </span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="container">
    <div class="main" style="padding:0px;margin:0 auto;width:100%;border:0px solid red;">
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
                        <img src="ivw/play.png" style="width:100%;"
                            onclick="document.getElementById('id0{{ $loop->iteration }}').style.display='block'">
                    </span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection