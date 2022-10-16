@extends('home.layout', [
'menu' => 'home'
])

@section('content')
<div class="row" style="margin-top: 100px;margin-left:0px;margin-right:0px">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators">
            @foreach ($sliders as $slider)
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $loop->iteration }}"
                class="{{ $loop->iteration == 1 ? 'active' : '' }}" aria-current="true"
                aria-label="{{ $slider->title }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach ($sliders as $slider)
            <div class="carousel-item {{ $loop->iteration == 1 ? 'active' : '' }}">
                <img src="{{ url('/storage/' . $slider->image) }}" class="d-block w-100" alt="...">
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="col-12 px-4 mt-3">
        <b>
            PRO-VOKASI
        </b>
    </div>
    <div class="row mt-3" style="margin: 0">
        @foreach ($provokasi_services as $item)
        <div class="col-6">
            <a href="{{ route('pro_vokasi.show', ['id' => $item->id]) }}" class="anchor-provokasi">
                <div class="card" style="width: 100%;">
                    <img src="{{ url('/storage/' . $item->banner) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text" style="font-size: 12px">Pelatihan Cost and Benefit Analysis / Analisa Biaya dan Manfaat</p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
