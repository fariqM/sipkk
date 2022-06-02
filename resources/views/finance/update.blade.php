@extends('layouts.app')

@section('css')
<link type="text/css" rel="stylesheet" href="{{ asset('assets/vendor/flatpickr/flatpickr.min.css') }}">
@endsection

@section('content')
<x-header-content>
    <a href="/account/index">Catatan Keuangan</a> / Ubah Data
</x-header-content>

<div class="main-content bg-clouds">
    <div class="container-fluid p-t-15">
        <div class="column bg-white is-flexible shadow-2dp ps" style="margin: 0 auto; width:50%">
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
                    <form action="{{ route('finance.update', ['finance' => $finance->id]) }}" method="POST" style="margin: 0 auto; width:70%">
                        @csrf

                        <div class="form-group col-md-12 ">
                            <label for="date">Tanggal</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="cd1">
                                    <i class="fa fa-fw fa-calendar-plus-o"></i>
                                </span>
                                <input class="form-control @error('date') input-error @enderror" id="date" name="date"
                                    placeholder="Masukkan Tanggal Pembukuan." value="{{ date('Y-m-d', strtotime($finance->date)) }}">
                            </div>
                            {{-- <label class="label-error" for="user_id">tes</label> --}}

                            @error('date')
                            <label class="label-error" for="date">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group col-md-12 ">
                            <label for="atext">Jenis Rekening</label>
                            <select class="form-control @error('account_id') input-error @enderror"
                                id="account_id" name="account_id">
                                <option value="" disabled selected>Pilih Jenis Rekening</option>
                                @foreach ($account as $item)
                                    <option {{ $finance->accountCategory->account_id == $item->id?'selected':'' }} value="{{  $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                            @error('account_category_id')
                            <label class="label-error" for="category">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group col-md-12 ">
                            <label for="atext">Sub Rekening</label>
                            <select class="form-control @error('account_category_id') input-error @enderror"
                                id="subaccount" name="account_category_id">
                                <option value="" disabled selected>Pilih Sub Rekening</option>
                                <option value="{{ $finance->account_category_id }}" selected>{{ $finance->accountCategory->title }} ({{ $finance->accountCategory->code }})</option>
                            </select>
                            @error('account_category_id')
                            <label class="label-error" for="category">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group col-md-12 ">
                            <label for="descForm">Keterangan</label>
                            {{-- <input type="text" class="form-control @error('description') input-error @enderror"
                                id="descForm" name="description" placeholder="Masukkan Keterangan Keuangan..."
                                value="{{ old('description') }}"> --}}
                                <textarea name="description" cols="30" rows="5" class="form-control">{{ $finance->description }}</textarea>
                            @error('description')
                            <label class="label-error" for="descForm">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group col-md-12 ">
                            <label for="debitForm">Debet</label>
                            <input type="number" min="0"
                                class="form-control @error('debit') input-error @enderror" id="debitForm" name="debit"
                                placeholder="Masukkan Debet (jik ada)." value="{{ $finance->debit }}">
                            @error('debit')
                            <label class="label-error" for="debitForm">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group col-md-12 ">
                            <label for="creditForm">Kredit</label>
                            <input type="number" min="0"
                                class="form-control @error('credit') input-error @enderror" id="creditForm"
                                name="credit" placeholder="Masukkan Kredit (jik ada)." value="{{ $finance->credit }}">
                            @error('credit')
                            <label class="label-error" for="creditForm">{{ $message }}</label>
                            @enderror
                        </div>

                        {{-- <div class="form-group col-md-12 ">
                            <label for="balanceForm">Saldo</label>
                            <input type="number" min="0"
                                class="form-control @error('balance') input-error @enderror" id="balanceForm"
                                name="balance" placeholder="Masukkan Saldo (jik ada)." value="{{ old('balance') }}">
                            @error('balance')
                            <label class="label-error" for="balanceForm">{{ $message }}</label>
                            @enderror
                        </div> --}}

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
<script src="{{ asset('assets/vendor/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('assets/vendor/cleave/cleave.min.js') }}"></script>
<script src="{{ asset('assets/vendor/cleave/addons/cleave-phone.us.js') }}"></script>

{{-- custom input --}}
<script>
    flatpickr("#date", {
        dateFormat: "d/m/Y",
    });
    $('#debitForm').keyup(function (e) {
        var val = $(this).val();
        console.log('12');
        var length = val.length;
        if (length > 0) {
            $('#creditForm').attr('disabled', true);
        }else{
            $('#creditForm').attr('disabled', false);
        }
    });
    $('#creditForm').keyup(function (e) {
        var val = $(this).val();
        console.log('21');
        var length = val.length;
        if (length > 0) {
            $('#debitForm').attr('disabled', true);
        }else{
            $('#debitForm').attr('disabled', false);
        }
    });
    $('#account_id').change(function (e) {
        e.preventDefault();
        // ajax
        var id = $(this).val();
        $.ajax({
            url: "{{ url('api/sub-account-data') }}/"+id,
            type: "GET",
            dataType: "json",
            success: function(data){
                var data = data.data;
                var html = '';
                html += '<option value="" disabled selected>Pilih Sub Rekening</option>';
                $.each(data, function(key, value) {
                    html += '<option value="'+value.id+'">'+value.title+' ('+value.code+')</option>';
                });
                $('#subaccount').html(html);
            }
        });
    });
</script>
{{-- end custom input --}}
@endsection
