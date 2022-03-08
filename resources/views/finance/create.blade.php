@extends('layouts.app')

@section('content')
<x-header-content>
    <a href="/finance/index">Catatan Keuangan</a> / Tambah Data
</x-header-content>

<div class="main-content bg-clouds">
    <div class="container-fluid p-t-15">
        <div class="column bg-white is-flexible shadow-2dp ps">
            <div class="box">
                <header class="bg-wet-asphalt text-white">
                    <h4>Setup Rekening</h4>
                    <!-- begin box-tools -->
                    <div class="box-tools">
                        <a class="fa fa-fw fa-minus" href="#" data-box="collapse"></a>
                        {{-- <a class="fa fa-fw fa-times" href="#" data-box="close"></a> --}}
                    </div>
                    <!-- END: box-tools -->
                </header>
                <div class="box-body collapse in">
                    <form action="/finance/store" method="POST">
                        @csrf
                        <div class="form-group col-md-7 ">
                            <label for="atext">Katergori Buku Rekening</label>
                            <div style="display: inline-table">
                                <select class="form-control @error('account_category_id') input-error @enderror"
                                    id="category" name="account_category_id">
                                    <option value="" disabled selected>Pilih Kategori Rekening</option>
                                    @foreach ($data as $item)
                                    @if ($item->id == old('account_category_id'))
                                    <option value="{{  $item->id }}" selected>{{ $item->title }} - ({{ $item->code }})</option>
                                    @endif
                                    <option value="{{  $item->id }}">{{ $item->title }} - ({{ $item->code }})</option>
                                    @endforeach
                                </select>
                                
                                <span class="input-group-addon" id="clear_addon" style="cursor: pointer">
                                    <a href="/account/create">Setup Rekening</a>
                                </span>
                            </div>
                            @error('account_category_id')
                            <label class="label-error" for="category">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group col-md-7 ">
                            <label for="descForm">Keterangan</label>
                            <input type="text" class="form-control @error('description') input-error @enderror"
                                id="descForm" name="description" placeholder="Masukkan Keterangan Keuangan..."
                                value="{{ old('description') }}">
                            @error('description')
                            <label class="label-error" for="descForm">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group col-md-7 ">
                            <label for="debitForm">Debet</label>
                            <input type="number" step="0.01" min="0"
                                class="form-control @error('debit') input-error @enderror" id="debitForm"
                                name="debit" placeholder="Masukkan Debet (jik ada)." value="{{ old('debit') }}">
                            @error('debit')
                            <label class="label-error" for="debitForm">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group col-md-7 ">
                            <label for="creditForm">Kredit</label>
                            <input type="number" step="0.01" min="0"
                                class="form-control @error('credit') input-error @enderror" id="creditForm"
                                name="credit" placeholder="Masukkan Kredit (jik ada)." value="{{ old('credit') }}">
                            @error('credit')
                            <label class="label-error" for="creditForm">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group col-md-7 ">
                            <label for="balanceForm">Saldo</label>
                            <input type="number" step="0.01" min="0"
                                class="form-control @error('balance') input-error @enderror" id="balanceForm"
                                name="balance" placeholder="Masukkan Saldo (jik ada)." value="{{ old('balance') }}">
                            @error('balance')
                            <label class="label-error" for="balanceForm">{{ $message }}</label>
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