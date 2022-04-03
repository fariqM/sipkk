@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/sweet-alert/sweetalert2.min.css') }}">
<link type="text/css" rel="stylesheet" href="{{ asset('assets/vendor/flatpickr/flatpickr.min.css') }}">
@endsection

@section('content')
<x-header-content>
    <a href="/event/index">Kegiatan</a> / Tambah Kegiatan
</x-header-content>

<div class="main-content bg-clouds">
    <div class="container-fluid p-t-15">
        <div class="column bg-white is-flexible shadow-2dp ps">
            <div class="box">
                <header class="bg-wet-asphalt text-white">
                    <h4>Form Kegiatan</h4>
                    <!-- begin box-tools -->
                    <div class="box-tools">
                        <a class="fa fa-fw fa-minus" href="#" data-box="collapse"></a>
                        {{-- <a class="fa fa-fw fa-times" href="#" data-box="close"></a> --}}
                    </div>
                    <!-- END: box-tools -->
                </header>
                <div class="box-body collapse in">
                    <form action="/event/store" method="POST" style="margin: 0 auto; width:40%">
                        @csrf

                        <div class="form-group col-md-12 ">
                            <label for="date">Tanggal</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="cd1">
                                    <i class="fa fa-fw fa-calendar-plus-o"></i>
                                </span>
                                <input class="form-control @error('date') input-error @enderror" id="date" name="date"
                                    placeholder="Masukkan Tanggal Pemberian." value="{{ old('date') }}">
                            </div>
                            {{-- <label class="label-error" for="user_id">tes</label> --}}

                            @error('date')
                            <label class="label-error" for="user_id">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <label for="event_id">Nama Kegiatan</label>
                            <div @role('Super Admin') style="display: inline-table" @endrole>
                                <select class="form-control @error('event_id') input-error @enderror" id="event_id"
                                    name="event_id">
                                    <option value="" disabled selected>Pilih Kegiatan</option>
                                    @foreach ($events as $item)
                                    @if (old('event_id') == $item->id)
                                    <option value="{{  $item->id }}" selected>{{ $item->description }}</option>
                                    @endif
                                    <option value="{{  $item->id }}">{{ $item->description }}</option>
                                    @endforeach
                                </select>
                                @role('Super Admin')
                                <span class="input-group-addon" id="clear_addon" style="cursor: pointer"
                                    onclick="addEvent()">Tambahkan
                                    Kegiatan</span>
                                @endrole
                            </div>
                            @error('event_id')
                            <label class="label-error" for="category">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <label for="user_id">Pemberi</label>
                            <select class="form-control @error('user_id') input-error @enderror" id="user_id"
                                name="user_id">
                                <option value="" disabled selected>Pilih Nama Pemberi</option>
                                @foreach ($users as $item)
                                @if (old('user_id') == $item->id)
                                <option value="{{  $item->id }}" selected>{{ $item->name }}</option>
                                @endif
                                <option value="{{  $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <label class="label-error" for="user_id">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <label for="balance">Nominal</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="cpr1">
                                    Rp
                                </span>
                                <input class="form-control @error('balance') input-error @enderror"
                                    id="balance" name="balance" placeholder="Masukkan Nominal Pemberian."
                                    value="{{ old('balance') }}">
                                {{-- <input id="balance" type="text" class="text-right cleave-cpr1 form-control"
                                    placeholder="Enter Numeral" aria-describedby="cpr1"> --}}
                            </div>

                            @error('balance')
                            <label class="label-error" for="balance">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" onclick="submit()" class="btn btn-flat btn-primary  u-posRelative">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="{{ asset('assets/vendor/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('assets/vendor/cleave/cleave.min.js') }}"></script>
<script src="{{ asset('assets/vendor/cleave/addons/cleave-phone.us.js') }}"></script>

{{-- custom input --}}
<script>
    flatpickr("#date", {
        dateFormat: "d/m/Y",
    });
    var cleave = new Cleave('#balance', {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand'
    });
</script>
@endsection
