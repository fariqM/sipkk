@extends('layouts.app')

@section('css')
<link type="text/css" rel="stylesheet" href="../assets/vendor/datatables/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
<x-header-content>
    Rekening
</x-header-content>

<div class="main-content bg-clouds">
    <div class="container-fluid p-t-15">
        <div class="box">
            <header>
                <h3>Datatable</h3>
                <div class="box-tools">
                    <a href="https://datatables.net/" target="_blank">datatables</a>
                </div>
            </header>
            <div class="box-body">
                <table id="accountTable" class="table table-striped table-bordered dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Kategori Rekening</th>
                            {{-- <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th> --}}
                        </tr>
                    </thead>
                    {{-- <tbody>
                        <tr>
                            <td>Hadi</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                        </tr>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                        </tr>
                    </tbody> --}}
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/pagejs/table-datatable.js') }}"></script>

<script>
    function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Full name:</td>'+
            '<td>'+d.title+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extra info:</td>'+
            '<td>And any further details here (images etc)...</td>'+
        '</tr>'+
    '</table>';
    }

    $(document).ready(function() {
    var table = $('#accountTable').DataTable( {
        "ajax": {
            url:'/api/account-data',
            dataSrc: ''
        },
        "columns": [
            {
                "className":      'dt-control',
                "orderable":      true,
                "data":           null,
                "defaultContent": ''
            },
            { "data": "title" },
        ],
        "order": [[1, 'asc']]
    } );
     
    // Add event listener for opening and closing details
    $('#accountTable tbody').on('click', 'td.dt-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child( format(row.data()) ).show();
                tr.addClass('shown');
            }
        });
    });

</script>
@endsection