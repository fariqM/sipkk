@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/sweet-alert/sweetalert2.min.css') }}">
@endsection

@section('content')
<x-header-content>
    <a href="/account/index">Rekening</a> / Tambah Rekening
</x-header-content>

<div class="main-content bg-clouds">
    <div class="container-fluid p-t-15">
        <div class="column bg-white is-flexible shadow-2dp ps justify-content-center" style="width: 50%; margin:auto auto;">
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
                    <form action="setup" method="POST" style="margin: 0 auto; width:70%">
                        @csrf
                        <div class="form-group col-md-12 ">
                            <label for="atext">Nama Rekening</label>
                            <input type="text" class="form-control" id="atext" name="title"
                                placeholder="Masukkan Nama Rekening...">
                        </div>

                        <div class="form-group col-md-12 ">
                            <label for="atext">Kode</label>
                            <input type="text" class="form-control" id="atext" name="code"
                                placeholder="Masukkan kode Rekening...">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="atext">Jenis Rekening</label>
                            <div style="display: inline-table">
                                <select class="form-control" id="category" name="account_id">
                                    <option value="" disabled selected>Pilih Kategori Rekening</option>
                                    @foreach ($data as $item)
                                    <option value="{{  $item->id }}">{{ $item->title }}</option>
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
{{-- sweet alert --}}
<script src="{{ asset('assets/vendor/sweet-alert/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/vendor/sweet-alert/sweetalert2.min.js') }}"></script>

<script>
    select = document.getElementById('category');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const addAccount = (data) => {
        $.ajax({
           type:'POST',
           url:"/api/add-account",
           data:{title:data},
           success:(response) => {
                console.log(response);
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

    const addCategory = () => {
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
                    addAccount(data)
                }
            },
        })
    }
</script>

<script>
    $('select[id=category]').change(function() {
            if ($(this).val() == '')
            {
                var newThing = prompt('Enter a name for the new thing:');
                var newValue = $('option', this).length;
                $('<option>')
                    .text(newThing)
                    .attr('value', newValue)
                    .insertBefore($('option[value=]', this));
                $(this).val(newValue);
            }
        });
</script>
@endsection
