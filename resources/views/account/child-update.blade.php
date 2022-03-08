@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/sweet-alert/sweetalert2.min.css') }}">
@endsection

@section('content')
<x-header-content>
    <a href="/account/index">Rekening</a> / Ubah Nama Kategori Rekening
</x-header-content>

<div class="main-content bg-clouds">
    <div class="container-fluid p-t-15">
        <div class="column bg-white is-flexible shadow-2dp ps">
            <div class="box">
                <header class="bg-wet-asphalt text-white">
                    <h4>Form Rekening</h4>
                    <!-- begin box-tools -->
                    <div class="box-tools">
                        <a class="fa fa-fw fa-minus" href="#" data-box="collapse"></a>
                        {{-- <a class="fa fa-fw fa-times" href="#" data-box="close"></a> --}}
                    </div>
                    <!-- END: box-tools -->
                </header>
                <div class="box-body collapse in">
                    <form action="{{ route('child.update', ['accountcategory' => $child->id]) }}" method="POST">
                        @csrf
                        <div class="form-group col-md-6 ">
                            <label for="atext">Nama Rekening</label>

                            <input type="text"
                                class="form-control @error('title') input-error @enderror" id="titleForm"
                                name="title" value="{{ $child->title }}"
                                placeholder="Ganti Nama Kategori Rekening Baru...">
                            @error('title')
                            <label class="label-error" for="titleForm">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-flat btn-primary  u-posRelative">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="{{ asset('assets/vendor/sweet-alert/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/vendor/sweet-alert/sweetalert2.min.js') }}"></script>
@endsection