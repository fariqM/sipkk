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
        <div class="column bg-white is-flexible shadow-2dp ps" style="margin: 0 auto; width:50%">
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
                    <form action="{{ route('parent.update', ['account' => $account->id]) }}" method="POST" style="margin: 0 auto; width:70%">
                        @csrf
                        <div class="form-group col-md-12 ">
                            <label for="atext">Nama Rekening</label>
                            <input type="text" class="form-control" id="atext" name="title"
                                placeholder="Masukkan Nama Rekening..." value="{{ $account->title }}">
                        </div>

                        <div class="form-group col-md-12 ">
                            <label for="atext">Kode</label>
                            <input type="text" class="form-control" id="atext" name="code"
                                placeholder="Masukkan kode Rekening..." value="{{ $account->code }}">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="atext">Jenis Rekening</label>
                            <div style="display: inline-table">
                                <select class="form-control" id="category" name="account_id">
                                    <option value="" disabled selected>Pilih Kategori Rekening</option>
                                    @foreach ($data as $item)
                                    <option {{ $item->id == $account->account_id ? 'selected' : '' }} value="{{  $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                </select>
                                <span class="input-group-addon" id="clear_addon" style="cursor: pointer"
                                    onclick="addCategory()">Tambahkan Jenis</span>
                            </div>
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
