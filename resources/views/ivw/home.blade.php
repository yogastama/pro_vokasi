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

<div class="modal fade" id="modal-register-login" tabindex="-1" aria-labelledby="modal-register-loginLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-light" id="modal-register-loginLabel">Akun</h1>
                <button type="button" class="btn-close text-light pr-4" data-bs-dismiss="modal">
                    Skip
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    Kamu belum login, silakan daftar atau login dibawah ini.
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="d-grid gap-2 mt-3">
                            <a href="{{ url('/desktop/register') }}" class="btn btn-danger btn-lg">
                                Daftar Akun
                            </a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-grid gap-2 mt-3">
                            <a href="{{ url('/desktop/login') }}" class="btn btn-outline-danger btn-lg">
                                Login Akun
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection