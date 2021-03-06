@extends('layouts.app')

@section('css')
{{-- datatable --}}
<link type="text/css" rel="stylesheet" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap.min.css') }}">

{{-- sweet alert --}}
<link rel="stylesheet" href="{{ asset('assets/vendor/sweet-alert/sweetalert2.min.css') }}">
@endsection

@section('content')
<x-header-content>
    Keuangan
</x-header-content>

<div class="main-content bg-clouds">
    <div class="container-fluid p-t-15">
        <div class="box">
            <header>
                <h3>Indeks Keuangan {{ $title }}</h3>
                <div class="box-tools">
                    <a href="/finance/create/{{ Str::slug($title) }}" class="btn btn-flat btn-primary  u-posRelative"
                        style="color: white">Tambahkan Catatan Keuangan</a>
                </div>
            </header>
            <div class="box-body">
                <table id="financeTable" class="table table-striped table-bordered dataTable " width="100%"
                    cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tgl Pembukuan</th>
                            <th>Kode Buku</th>
                            <th>Keterangan</th>
                            <th>Debit</th>
                            <th>Kredit</th>
                            <th>Saldo</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ date_format(date_create_from_format("Y-m-d", $item->date), 'd/m/Y') }}</td>
                            <td>{{ $item->account->code }} ({{ $item->account->title }})</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->debit }}</td>
                            <td>{{ $item->credit }}</td>
                            <td>{{ $item->balance }}</td>
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

<script>
    $(document).ready( function () {
        $('#financeTable').DataTable({
            "ordering": false
        });
    });

    const showFinance= (id) => {
        window.location = `/finance/show/${id}`
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
