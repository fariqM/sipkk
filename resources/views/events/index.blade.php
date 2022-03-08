@extends('layouts.app')

@section('css')
{{-- datatable --}}
<link type="text/css" rel="stylesheet" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap.min.css') }}">

{{-- sweet alert --}}
<link rel="stylesheet" href="{{ asset('assets/vendor/sweet-alert/sweetalert2.min.css') }}">
@endsection

@section('content')
<x-header-content>
    Kegiatan
</x-header-content>

<div class="main-content bg-clouds">
    <div class="container-fluid p-t-15">
        <div class="box">
            <header>
                <h3>Indeks Kegiatan</h3>
                <div class="box-tools">
                    <a href="/event/create" class="btn btn-flat btn-primary  u-posRelative"
                        style="color: white">Tambahkan Pemasukan</a>
                </div>
            </header>
            <div class="box-body">
                <table id="eventsTable" class="table table-striped table-bordered dataTable " width="100%"
                    cellspacing="0">
                    <thead>
                        <tr>
                            <th>Expand</th>
                            <th>Judul Kegiatan</th>
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
                deleteParent(data.id).then(response => {
                    let table = $('#eventsTable').DataTable();
                    table.ajax.reload();
                }) 
            }
        })
    }

    const updateAlert = (data) => {
        Swal.fire({
            title: 'Ubah nama kegiatan ?',
            text: "Masukkan nama kegiatan yang baru",
            html:`Nama kegiatan sebelumnya : <b>${data.description}</b>.</br>`+
            `Masukkan nama kegiatan yang baru.`,
            input:'text',
            icon: 'question',
            cancelButtonText:'Batalkan',
            showCancelButton: true,
            confirmButtonColor: '#337AB7',
            cancelButtonColor: '#6A6A6A',
            confirmButtonText: 'Ubah',
            preConfirm: (input) => {
                if (input==="" || input===null) {
                    alertError('Input kosong!')
                } else {
                    updateParent(data.id, input).then(response => {
                        let table = $('#eventsTable').DataTable();
                        table.ajax.reload()
                    })
                }
            },
            })
    }

    const deleteChildAlert = (id) => {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Aksi ini akan menghapus catatan donasi/transaksi terpilih.",
            icon: 'warning',
            cancelButtonText:'Tidak',
            showCancelButton: true,
            confirmButtonColor: '#C9302C',
            cancelButtonColor: '#337AB7',
            confirmButtonText: 'Ya, Hapus'
            }).then((result) => {
            if (result.isConfirmed) {
                deleteChild(id).then(response => {
                    let table = $('#eventsTable').DataTable();
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


{{-- action script --}}
<script>
    const customDateFormat = (date) => {
        // console.log(date);
        var dateParts = date.split("-");
        var jsDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2].substr(0,2)).toLocaleDateString('en-US', {year: 'numeric', month: '2-digit', day: '2-digit'})
        return jsDate;
        // return jsDate
    }

    const numberWithCommas = (value) => {
        var parts = value.toString().split(".");
		parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		return parts.join(".");
    }

    const deleteParent = async (id) => {
        await 
        $.ajax({
           type:'DELETE',
           url:`/api/delete-event/${id}`,
           success:(response) => {
                alertSuccess('Kegiatan berhasil dihapus')
            },
           error:(e) =>{
                console.log(e);
                alertError('Gagal menghapus data.')
           }
        });
    }

    const deleteChild = async (id) => {
        await 
        $.ajax({
           type:'DELETE',
           url:`/api/delete-child-event/${id}`,
           success:(response) => {
                alertSuccess('Kegiatan berhasil dihapus')
            },
           error:(e) =>{
                console.log(e);
                alertError('Gagal menghapus data.')
           }
        });
    }

    const updateParent = async (id, input) => {
        await
        $.ajax({
           type:'POST',
           url:`/api/update-event/${id}`,
           data:{description:input},
           success:(response) => {
                alertSuccess('Nama kegiatan berhasil diganti')
                return response
            },
           error:(e) =>{
                console.log(e);
                alertError('Gagal mengganti nama kegiatan.')
           }
        });
    }

    const editChild = (id) => {
        window.location = `/event/update/${id}`
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
        var table = $('#eventsTable').DataTable( {
            "ajax": {
                url:'/api/events-data',
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
                { "data": "description" },
                {
                "data": null,
                "defaultContent": "<button id='delete' class='btn-flat btn-danger' style='margin-right:1rem'>Hapus</button><button id='update' class='btn-flat btn-primary'>Ubah</button>"
                }
            ],
            "order": [[1, 'asc']]
        });

        // update action
        $('#eventsTable tbody').on('click', '#update', function () {
            var data = table.row( $(this).parents('tr') ).data();
            updateAlert(data)
        });

        // delete action
        $('#eventsTable tbody').on('click', '#delete', function () {
            var data = table.row( $(this).parents('tr') ).data();
            deleteAlert(data)
        });
        
        // Add event listener for opening and closing details
        $('#eventsTable tbody').on('click', 'td.dt-control', function () {
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
@endsection