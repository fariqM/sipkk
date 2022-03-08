@extends('layouts.app')

@section('css')
{{-- datatable --}}
<link type="text/css" rel="stylesheet" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap.min.css') }}">

{{-- sweet alert --}}
<link rel="stylesheet" href="{{ asset('assets/vendor/sweet-alert/sweetalert2.min.css') }}">
@endsection

@section('content')
<x-header-content>
    Pengguna
</x-header-content>

<div class="main-content bg-clouds">
    <div class="container-fluid p-t-15">
        <div class="box">
            <header>
                <h3>Data Pengguna</h3>
                <div class="box-tools">
                    <a href="/user/create" class="btn btn-flat btn-primary  u-posRelative"
                        style="color: white">Tambahkan Pengguna</a>
                </div>
            </header>
            <div class="box-body">
                <table id="usersTable" class="table table-striped table-bordered dataTable " width="100%"
                    cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Jabatan</th>
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

{{-- show modal/alert script --}}
<script>
    const deleteAlert = (data) => {
        Swal.fire({
            title: 'Yakin ingin menghapus pengguna ?',
            text: "Data yang telah dihapus tidak dapat dikembalikan.",
            icon: 'warning',
            cancelButtonText:'Tidak',
            showCancelButton: true,
            confirmButtonColor: '#C9302C',
            cancelButtonColor: '#337AB7',
            confirmButtonText: 'Ya, Hapus'
            }).then((result) => {
            if (result.isConfirmed) {
                deleteAction(data.id).then(response => {
                    let table = $('#usersTable').DataTable();
                    table.ajax.reload();
                }) 
            }
        })
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
</script>
{{-- end show modal/alert script --}}

<script>
    const deleteAction = async (id) => {
        await 
        $.ajax({
           type:'DELETE',
           url:`/api/delete-user/${id}`,
           success:(response) => {
                alertSuccess('Pengguna berhasil dihapus')
            },
           error:(e) =>{
                console.log(e);
                alertError('Gagal menghapus pengguna.')
           }
        });
    }
</script>

{{-- creating datatable --}}
<script>
    function format ( d ) {
        // console.log(d);
        if (d.incomes.length>0) {
            let row = ''
            d.incomes.forEach(element => {
            row +=`<tr>
                        <td>${customDateFormat(element.date)}</td>
                        <td>${element.user.name}</td>
                        <td>Rp ${numberWithCommas(element.balance)}</td>
                        <td>
                            <button style='margin-right:1rem' class='btn-flat btn-danger' onclick="deleteChildAlert(${element.id})">Hapus Catatan</button>
                            <button style='margin-right:1rem' class='btn-flat btn-primary' onclick="editChild(${element.id})">Ubah Catatan</button>
                        </td>
                    </tr>`
            });
            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;" class="table table-striped-expand  table-bordered">'+
                        '<thead>'+
                            '<tr>'+
                                '<th>Tanggal</th>'+
                                '<th>Pemberi</th>'+
                                '<th>Nominal</th>'+
                                '<th>Aksi</th>'+
                            '</tr>'+
                        '</thead>'+
                        '<tbody>'+
                            row
                        '</tbody>'+
                    '</table>';
        } else {
            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;" class="table table-striped-expand  table-bordered">'+
                        '<thead>'+
                            '<tr>'+
                                '<th>Tanggal</th>'+
                                '<th>Pemberi</th>'+
                                '<th>Nominal</th>'+
                            '</tr>'+
                        '</thead>'+
                        '<tbody>'+
                            '<tr class="odd"><td valign="top" colspan="3" class="dataTables_empty">Tidak ada pemasukan untuk kegiatan ini.</td></tr>'+
                        '</tbody>'+
                    '</table>';
        }
        // `d` is the original data object for the row
       
    }

    // #### start create datatable ####
    $(document).ready(function() {
        var table = $('#usersTable').DataTable( {
            "ajax": {
                url:'/user/users-data',
                dataSrc: ''
            },
            responsive: {
            details: {
                type: 'column',
                target: -1
            }
        },
            "columns": [
                { "data": "name" },
                { "data": "email" },
                { "data": "roles[0].name" },
                {
                "data": null,
                "defaultContent": "<button id='delete' class='btn-flat btn-danger' style='margin-right:1rem'>Hapus</button><button id='update' class='btn-flat btn-primary'>Ubah</button>"
                }
            ],
            "order": [[1, 'asc']]
        });

        // update action
        $('#usersTable tbody').on('click', '#update', function () {
            var data = table.row( $(this).parents('tr') ).data();
            window.location = `/user/update/${data.id}`
        });

        // delete action
        $('#usersTable tbody').on('click', '#delete', function () {
            var data = table.row( $(this).parents('tr') ).data();
            deleteAlert(data)
        });
        
        // Add event listener for opening and closing details
        $('#usersTable tbody').on('click', 'td.dt-control', function () {
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
    // #### end create datatable ####

</script>
{{-- end creating datatable --}}
@endsection