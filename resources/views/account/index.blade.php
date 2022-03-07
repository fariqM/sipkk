@extends('layouts.app')

@section('css')
<link type="text/css" rel="stylesheet" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/sweet-alert/sweetalert2.min.css') }}">
@endsection

@section('content')
<x-header-content>
    Rekening
</x-header-content>

<div class="main-content bg-clouds">
    <div class="container-fluid p-t-15">
        <div class="box">
            <header>
                <h3>Indeks Rekening</h3>
                <div class="box-tools">
                    <a href="/account/create"  class="btn btn-flat btn-primary  u-posRelative" style="color: white">Tambahkan Rekening</a>
                </div>
            </header>
            <div class="box-body">
                <table id="accountTable" class="table table-striped table-bordered dataTable " width="100%"
                    cellspacing="0">
                    <thead>
                        <tr >
                            <th>Expand</th>
                            <th>Kategori Rekening</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
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
    function hapusBuku (){
        alert('ok')
    }

    function format ( d ) {
        let row = ''
        d.categories.forEach(element => {
           row +=`<tr><td>${element.code}</td><td>${element.title}</td><td><button class='btn-flat btn-danger' onclick="hapusBuku()">Hapus Buku</button></td></tr>`
        });
        // `d` is the original data object for the row
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;" class="table table-striped-expand  table-bordered">'+
            '<thead>'+
                '<tr>'+
                    '<th>Kode</th>'+
                    '<th>Nama Rekening</th>'+
                    '<th>Aksi</th>'+
                '</tr>'+
            '</thead>'+
            '<tbody>'+
                row
            '</tbody>'+
        '</table>';
    }

    $(document).ready(function() {
        var table = $('#accountTable').DataTable( {
            "ajax": {
                url:'/api/account-data',
                dataSrc: ''
            },
            responsive: {
            details: {
                type: 'column',
                target: -1
            }
        },
            "columns": [
                {
                    "className":      'dt-control',
                    "orderable":      true,
                    "data":           null,
                    "defaultContent": ""
                },
                { "data": "title" },
                {
                "data": null,
                "defaultContent": "<button id='delete' class='btn-flat btn-danger' style='margin-right:1rem'>Hapus</button><button id='update' class='btn-flat btn-primary'>Ubah</button>"
                }
            ],
            "order": [[1, 'asc']]
        });

        // update action
        $('#accountTable tbody').on('click', '#update', function () {
            var data = table.row( $(this).parents('tr') ).data();
            window.location = `/account/parent-update/${data.id}`
        });

        // delete action
        $('#accountTable tbody').on('click', '#delete', function () {
            var data = table.row( $(this).parents('tr') ).data();
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
                    table.ajax.reload();
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                }
            })
        });
        
        // Add event listener for opening and closing details
        $('#accountTable tbody').on('click', 'td.dt-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row( tr );
    
                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                    $(this).closest('td').removeClass('row-haschild ')
                }
                else {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                    $(this).closest('td').addClass('row-haschild ')
                }
            });
    });

</script>
@endsection