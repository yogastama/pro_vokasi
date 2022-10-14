@extends('home.layout', [
    'menu' => 'home'
])

@section('content')
<div class="row" style="margin-top: 80px;margin-left:0px;margin-right:0px">
    <div class="col-12 px-4">
        <b>
            LAYANAN
        </b>
    </div>
    <div class="row mt-3">
        <div class="col-12 px-4">
            <div class="row">
                <div class="col-6 mt-3 text-center">
                    <a href="https://siva.kemenperin.go.id" class="text-decoration-none">
                        <div class="service-icon">
                            <div style="height: 100px;">
                                <img src="{{ url('/images/others/siva.png') }}" alt="siva" width="100%">
                            </div>
                            <div>
                                <small class="text-muted">SIVA</small>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 mt-3 text-center">
                    <a href="https://cdcbpsdmi.kemenperin.go.id/" class="text-decoration-none">
                        <div class="service-icon">
                            <div style="height: 100px;">
                                <img src="{{ url('/images/others/cdc.png') }}" alt="siva" width="100%">
                            </div>
                            <div>
                                <small class="text-muted">CDC</small>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 mt-3 text-center">
                    <a href="https://jarvis.kemenperin.go.id/" class="text-decoration-none">
                        <div class="service-icon">
                            <div style="height: 100px;">
                                <img src="{{ url('/images/others/jarvis.png') }}" alt="siva" width="100%">
                            </div>
                            <div>
                                <small class="text-muted">JARVIS</small>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 mt-3 text-center">
                    <a href="https://coachingclinicstd.kemenperin.go.id/" class="text-decoration-none">
                        <div class="service-icon">
                            <div style="height: 100px;">
                                <img src="{{ url('/images/others/std.png') }}" alt="siva" width="100%" class="rounded">
                            </div>
                            <div>
                                <small class="text-muted">COACHING</small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection