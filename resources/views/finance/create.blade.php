@extends('layouts.app')

@section('css')
<link type="text/css" rel="stylesheet" href="{{ asset('assets/vendor/flatpickr/flatpickr.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/sweet-alert/sweetalert2.min.css') }}">
@endsection

@section('content')
<x-header-content>
    <a href="/finance/index">Catatan Keuangan</a> / Tambah Data
</x-header-content>

<div class="main-content bg-clouds">
    <div class="container-fluid p-t-15">
        <div class="column bg-white is-flexible shadow-2dp ps">
            <div class="box">
                <header class="bg-wet-asphalt text-white">
                    <h4>Tambah Catatan Keuangan</h4>
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
                            <label for="date">Tanggal</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="cd1">
                                    <i class="fa fa-fw fa-calendar-plus-o"></i>
                                </span>
                                <input class="form-control @error('date') input-error @enderror" id="date" name="date"
                                    placeholder="Masukkan Tanggal Pembukuan." value="{{ old('date') }}">
                            </div>
                            {{-- <label class="label-error" for="user_id">tes</label> --}}

                            @error('date')
                            <label class="label-error" for="date">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group col-md-7 ">
                            <label for="atext">Jenis Rekening</label>
                            <div @hasrole('Super Admin') style="display: inline-table" @endhasrole>
                                <select class="form-control @error('account_id') input-error @enderror"
                                    onchange="selectAccount(0)" id="account_drop" name="account_id">
                                    <option value="" disabled selected>Pilih Jenis Kategori Rekening</option>
                                    @foreach ($account as $item)
                                    @if ($item->id == old('account_id'))
                                    <option value="{{  $item->id }}" selected>{{ $item->title }}</option>
                                    @else
                                    <option value="{{  $item->id }}">{{ $item->title }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @hasrole('Super Admin')
                                <span class="input-group-addon" id="clear_addon" onclick="addAccount()"
                                    style="cursor: pointer; min-width:16rem">
                                    Setup Rekening
                                </span>
                                @endhasrole
                            </div>
                            @error('account_id')
                            <label class="label-error" for="category">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group col-md-7 ">
                            <label for="atext">Sub Rekening</label>
                            <div @hasrole('Super Admin') style="display: inline-table" @endhasrole>
                                <select class="form-control @error('account_category_id') input-error @enderror"
                                    id="subaccount" name="account_category_id">
                                    @if (old('account_category_id'))
                                    <option value="" disabled>Pilih Sub Rekening</option>
                                    <option value="{{  old('account_category_id') }}" selected>Loading...</option>
                                    @else
                                    <option value="" disabled selected>Pilih Sub Rekening</option>
                                    @endif

                                </select>
                                @hasrole('Super Admin')
                                <span class="input-group-addon" id="clear_addon"
                                    style="cursor: pointer; min-width:16rem">
                                    <a href="/account/create">Setup Sub-Rekening</a>
                                </span>
                                @endhasrole
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
                                class="form-control @error('debit') input-error @enderror" id="debitForm" name="debit"
                                placeholder="Masukkan Debet (jik ada)." value="{{ old('debit') }}">
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

@section('js')
<script src="{{ asset('assets/vendor/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('assets/vendor/cleave/cleave.min.js') }}"></script>
<script src="{{ asset('assets/vendor/cleave/addons/cleave-phone.us.js') }}"></script>

{{-- sweet alert --}}
<script src="{{ asset('assets/vendor/sweet-alert/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/vendor/sweet-alert/sweetalert2.min.js') }}"></script>



{{-- modal/dialog script --}}
<script>
    const addAccount = () => {
        Swal.fire({
            title: 'Tambahkan Jenis Rekening',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Tambahkan',
            cancelButtonText:'Batalkan',
            showLoaderOnConfirm: true,
            confirmButtonColor: '#C9302C',
            cancelButtonColor: '#337AB7',
            preConfirm: (data) => {
                if (data==="" || data===null) {
                    Swal.fire(
                        'gagal!',
                        'Input Kosong!',
                        'error'
                    )
                } else {
                    addAccountAction(data)
                }
            },
        })
    }
</script>

{{-- action script --}}
<script>
    select = document.getElementById('account_drop');
    sub_account = document.getElementById('subaccount');
    const oldValSub = sub_account.value;
    let helpers = 0;

    const appendSub = (responseArray, isSelected) => {
        if (isSelected) {
            responseArray.forEach(element => {
                if (oldValSub == element.id) {
                    $('#subaccount')
                        .append(`<option value="${element.id}" selected>${element.title} - (${element.code})</option>`);
                } else {
                    $('#subaccount')
                        .append(`<option value="${element.id}">${element.title} - (${element.code})</option>`);
                }
            });
        } else {
            responseArray.forEach(element => {
                $('#subaccount')
                    .append(`<option value="${element.id}">${element.title} - (${element.code})</option>`);
            });
        }
    } 

    const addAccountAction = (data) => {
        // console.log('add');
        $.ajax({
           type:'POST',
           url:"/api/add-account",
           data:{title:data},
           success:(response) => {
                Swal.fire(
                    'Sukses!',
                    'Data berhasil ditambahkan!',
                    'success'
                )
                var opt = document.createElement('option');
                opt.value = response.id;
                opt.innerHTML = response.title;
                select.appendChild(opt);
            },
           error:(e) =>{
            console.log(e);
            Swal.fire(
                    'gagal!',
                    'Ada yang error!',
                    'error'
                )
           }
        });
    }

    const selectAccount = (selectParam) =>{
        $.ajax({
            type:'GET',
            url:`/api/sub-account-data/${select.value}`,
            success:(response) => {
                if (selectParam!==0 && oldValSub !== '') {
                    $('#subaccount')
                        .find('option')
                        .remove()
                        .end()
                        .append('<option value="" disabled>Pilih Sub Rekening</option>');
                    appendSub(response.data, true)
                } else {
                    
                    if (response.data.length == 0) {
                        $('#subaccount')
                        .find('option')
                            .remove()
                            .end()
                            .append('<option value="" disabled selected>Mohon isi sub rekening terlebih dahulu.</option>');
                    } else {
                        $('#subaccount')
                            .find('option')
                            .remove()
                            .end()
                            .append('<option value="" disabled selected>Pilih Sub Rekening</option>');
                    }
                    appendSub(response.data, false)
                }
            },
            error:(e) =>{
                console.log(e);
                Swal.fire(
                        'gagal!',
                        'Ada yang error!',
                        'error'
                    )
            }
        })
    }
</script>

@if ($errors->any())
@error('account_category_id')
<script>
    // console.log('oldValSUb => ' + oldValSub);
    helpers = 1
    if (select.value) {
        const showChild2 = () =>{
            $.ajax({
                type:'GET',
                url:`/api/sub-account-data/${select.value}`,
                success:(response) => {   
                    if (response.data.length == 0) {
                        $('#subaccount')
                            .find('option')
                            .remove()
                            .end()
                            .append('<option value="" disabled selected>Mohon isi sub rekening terlebih dahulu.</option>');
                    } else {
                        if (oldValSub!=='') {
                            $('#subaccount')
                                .find('option')
                                .remove()
                                .end()
                                .append('<option value="" disabled>Pilih Sub Rekening</option>');
                        } else {
                            $('#subaccount')
                                .find('option')
                                .remove()
                                .end()
                                .append('<option value="" disabled selected>Pilih Sub Rekening</option>');
                        }
                        appendSub(response.data, true)
                    }
                },
            })
        }

        showChild2()
    }
    
</script>
@enderror
<script>
    // console.log('helpers => ' + helpers);
    if (helpers==0) {
        selectAccount(1)
    }
</script>
@endif


{{-- custom input --}}
<script>
    // flatpickr("#date", {
    //     dateFormat: "d/m/Y",
    // });
    // var cleave = new Cleave('#balance', {
    //     prefix: 'Rp ',
    //     numeral: true,
    //     numeralThousandsGroupStyle: 'thousand'
    // });
</script>
{{-- end custom input --}}
@endsection