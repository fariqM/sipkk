@extends('layouts.app')

@section('css')
{{-- datatable --}}
<link type="text/css" rel="stylesheet" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap.min.css') }}">
@endsection


@section('content')
<x-header-content>
    Dasbor
</x-header-content>

<div class="main-content bg-clouds">
    <div class="container-fluid p-t-15">
        <div class="box">
            <header>
                <h3>Catatan Keuangan</h3>
                <div class="box-tools">
                    <a class="fa fa-fw fa-minus" href="#" data-box="collapse"></a>
                </div>
            </header>
            <div class="box-body">
                <table id="eventsTable1" class="table table-striped table-bordered dataTable " width="100%"
                    cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Jenis Rekening</th>
                            <th>Kode</th>
                            <th>Keterangan</th>
                            <th>Debit</th>
                            <th>Kredit</th>
                            <th>Saldo</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($finance as $item)
                            <tr>
                                <td>{{ date('d/m/Y', strtotime($item->date)) }}</td>
                                <td>{{ $item->accountCategory->account->title }}</td>
                                <td class="{{ Str::length($item->accountCategory->code) > 4 ? 'text-right' : 'text-left' }}">{{ $item->accountCategory->code }}</td>
                                <td>{{ $item->description }}</td>
                                <td>Rp. {{ number_format($item->debit) }}</td>
                                <td>Rp. {{ number_format($item->credit) }}</td>
                                <td>Rp. {{ number_format($item->balance) }}</td>
                                <td>
                                    <button style="margin-right: 1rem" class='btn-flat btn-danger'
                                        onclick="deleteModal({{ $item->id }})">Hapus</button>
                                    <button class='btn-flat btn-primary' onclick="showFinance({{ $item->id }})">Ubah</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="container-fluid p-t-15">
        <div class="box">
            <header>
                <h3>Catatan Kegiatan</h3>
                <div class="box-tools">
                    <a class="fa fa-fw fa-minus" href="#" data-box="collapse"></a>
                </div>
            </header>
            <div class="box-body">
                <table id="eventsTables" class="table table-striped table-bordered dataTable " width="100%"
                    cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Anggota</th>
                            <th>Tanggal Pembukuan</th>
                            <th>Pemberi</th>
                            <th>Nominal</th>
                            <th>Kegiatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($incomes as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->id }}</td>
                                <td>{{ date('d/m/Y',strtotime($item->date)) }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>Rp. {{ number_format($item->balance,2,',','.') }}</td>
                                <td>{{ $item->event->description }}</td>
                                <td>
                                    <button id='update' onclick="deleteAlert({{ $item }})" class='btn btn-danger' style='margin-right:1rem'>Hapus</button>
                                    <a href="{{ route('event.show',$item) }}" class='btn btn-primary'>Ubah</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection

@section('js')
{{-- datatable --}}
<script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/pagejs/table-datatable.js') }}"></script>

{{-- sweet alert --}}
<script src="{{ asset('assets/vendor/sweet-alert/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/vendor/sweet-alert/sweetalert2.min.js') }}"></script>


{{-- creating datatable events --}}
<script>

    // #### start create datatable ####
    $(document).ready(function() {
        $('#eventsTable1').DataTable()
        $('#eventsTables').DataTable()
    })

    const showFinance= (id) => {
        window.location = `/finance/show/${id}`
    }

    const alertSuccess = (message) => {
        Swal.fire(
            'Sukses!',
            message,
            'success'
        )
    }

    const alertError = (message) => {
        Swal.fire(
            'gagal!',
            message,
            'error'
        )
    }

    const deleteAlert = (data) => {
        // console.log(data);
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Aksi ini akan menghapus catatan donasi/transaksi yang terkait dengan kegiatan ini.",
            icon: 'warning',
            cancelButtonText:'Tidak',
            showCancelButton: true,
            confirmButtonColor: '#C9302C',
            cancelButtonColor: '#337AB7',
            confirmButtonText: 'Ya, Hapus'
            }).then((result) => {
            if (result.isConfirmed) {
                deleteChild(data.id).then(response => {
                    let table = $('#eventsTable').DataTable();
                    table.ajax.reload();
                })
            }
        })
    }

    const deleteChild = async (id) => {
        await
        $.ajax({
           type:'DELETE',
           url:`/api/delete-child-event/${id}`,
           success:(response) => {
                alertSuccess('Kegiatan berhasil dihapus')
                location.reload()
            },
           error:(e) =>{
                console.log(e);
                alertError('Gagal menghapus data.')
           }
        });
    }

    const deleteAction = async (id) => {
        $.ajax({
           type:'DELETE',
           url:`/api/delete-finance/${id}`,
           success:(response) => {
                Swal.fire(
                    'Sukses!',
                    'Berhasil terhapus.',
                    'success'
                )
                return response
            },
           error:(e) =>{
               console.log(e);
                Swal.fire(
                    'Gagal!',
                    'Ada yang error.',
                    'success'
                )
                return e
           }
        });
    }

    const deleteModal = (id) => {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Aksi ini akan menghapus semua nomor rekening yang termasuk dalam kategori.",
            icon: 'warning',
            cancelButtonText:'Tidak',
            showCancelButton: true,
            confirmButtonColor: '#C9302C',
            cancelButtonColor: '#337AB7',
            confirmButtonText: 'Ya, Hapus'
            }).then((result) => {
            if (result.isConfirmed) {
                deleteAction(id).then(response => {
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                    // var table = $('#financeTable').DataTable( {
                    //     ajax: "/api/finance-data"
                    // });
                    // table.ajax.reload();
                })
            }
        })
    }
</script>

@endsection
