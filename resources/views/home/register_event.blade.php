@extends('home.layout', [
'menu' => 'events'
])

@section('content')
<div class="row" style="margin-top: 80px;margin-left:0px;margin-right:0px;padding-bottom: 100px;">
    <div class="col-12 px-4">
        <h3>
            Form Pendaftaran
        </h3>
        <hr>
    </div>
    <div class="row mt-3">
        <div class="col-12 px-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <img src="{{ url('/storage/' . $event->banner) }}" alt="" width="100%">
                                </div>
                                <div class="col-8">
                                    <b>
                                        {{ $event->title }}
                                    </b>
                                    <div style="font-size: 10px" class="mt-2">
                                        <i class="fa-solid fa-calendar"></i>
                                        {{ date('d M Y H:i', strtotime($event->start_event)) }} -
                                        {{ date('d M Y H:i', strtotime($event->close_event)) }}
                                    </div>
                                    <div class="mt-2">
                                        <div class="badge text-bg-warning">{{ $event->category_event->title }}</div>
                                        <span class="badge text-bg-info">{{ ucwords($event->type_event) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <form action="">
                        <div class="form-group mt-2">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group mt-2">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email">
                        </div>
                        <div class="form-group mt-2">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone">
                            <small class="text-muted">Contoh : 089617565844</small>
                        </div>
                        <div class="form-group mt-2">
                            <label for="jenis_kelamin">Jenis kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                <option value="laki_laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="instansi">Instansi</label>
                            <input type="text" class="form-control" name="instansi">
                        </div>
                        <div class="d-grid gap-2 mt-3">
                            <button class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
