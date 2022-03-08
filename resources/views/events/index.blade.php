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
                            <button style='margin-right:1rem' class='btn-flat btn-danger' onclick="hapusBuku(${element.id})">Hapus Buku</button>
                            <button style='margin-right:1rem' class='btn-flat btn-primary' onclick="editChild(${element.id})">Ubah</button>
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
            window.location = `/account/parent-update/${data.id}`
        });

        // delete action
        $('#eventsTable tbody').on('click', '#delete', function () {
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
                    deleteParent(data.id).then(response => {
                        table.ajax.reload();
                    }) 
                }
            })
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
</script>
@endsection