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

        <div class="row inview">
            <!-- BEGIN: Kredit -->
            <div class="col-sm-6">
                <div class="box">
                    <header class="b-b">
                        <h4>Kredit Bulan Kemarin</h4>
                        <!-- begin box-tools -->
                        <div class="box-tools">
                            <a class="fa fa-fw fa-minus" href="#" data-box="collapse"></a>
                        </div>
                        <!-- END: box-tools -->
                    </header>
                    <div class="box-body ">
                        <canvas id="creditData" width="200" height="100"></canvas>
                    </div>
                </div>
            </div>
            <!-- END: Kredit -->

            <!-- BEGIN: Debet -->
            <div class="col-sm-6">
                <div class="box">
                    <header class="b-b">
                        <h4>Debet Bulan Kemarin</h4>
                        <!-- begin box-tools -->
                        <div class="box-tools">
                            <a class="fa fa-fw fa-minus" href="#" data-box="collapse"></a>
                        </div>
                        <!-- END: box-tools -->
                    </header>
                    <div class="box-body ">
                        <canvas id="debitData" width="200" height="100"></canvas>
                    </div>
                </div>
            </div>
            <!-- END: Debet -->
        </div>

        <div class="row inview">
            <!-- BEGIN: Kredit -->
            <div class="col-md-4">
                <div class="box">
                    <header class="b-b">
                        <h4>Saldo Bulan Kemarin</h4>
                        <!-- begin box-tools -->
                        <div class="box-tools">
                            <a class="fa fa-fw fa-minus" href="#" data-box="collapse"></a>
                        </div>
                        <!-- END: box-tools -->
                    </header>
                    <div class="box-body ">
                        <canvas id="balanceData" width="100" height="80"></canvas>
                    </div>
                </div>
            </div>
            <!-- END: Kredit -->

            <!-- BEGIN: Debet -->
            <div class="col-md-8">
                <div class="box">
                    <header class="b-b">
                        <h4>Saldo Bulan Kemarin</h4>
                        <div class="box-tools">
                            <a class="fa fa-fw fa-minus" href="#" data-box="collapse"></a>
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
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                    <td>Data Kosong</td>
                                </tr> --}}
                                @foreach ($finance as $item)
                                <tr>
                                    <td>{{ date_format(date_create_from_format("Y-m-d", $item->date), 'd/m/Y') }}</td>
                                    <td>{{ $item->account->code }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->debit }}</td>
                                    <td>{{ $item->credit }}</td>
                                    <td>{{ $item->balance }}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END: Debet -->
        </div>

        <div class="box">
            <header>
                <h3>Catatan Kegiatan</h3>
                <div class="box-tools">
                    <a class="fa fa-fw fa-minus" href="#" data-box="collapse"></a>
                </div>
            </header>
            <div class="box-body">
                <table id="eventsTable" class="table table-striped table-bordered dataTable " width="100%"
                    cellspacing="0">
                    <thead>
                        <tr>
                            <th>Expand</th>
                            <th>Judul Kegiatan</th>
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


{{-- creating datatable events --}}
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
                    </tr>`
            });
            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;" class="table table-striped-expand  table-bordered">'+
                        '<thead>'+
                            '<tr>'+
                                '<th>Tanggal</th>'+
                                '<th>Pemberi</th>'+
                                '<th>Nominal</th>'+
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
            ],
            "order": [[1, 'asc']]
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

{{-- creating datatable finance --}}
<script>
    $(document).ready( function () {
        $('#financeTable').DataTable({
            pageLength : 5,
            lengthMenu :[5, 10, 20, 50, 100],
        });
    });
</script>

{{-- chart-js --}}
<script src="{{ asset('assets/vendor/chart-js/chart.js') }}"></script>

{{-- chart styling --}}
<script>
    const legendText = {
        color: '#911',
        font: {
            family: 'Comic Sans MS',
            size: 15,
            weight: 'bold',
            lineHeight: 1.2,
        },
    }

    const bgColor = ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'];
    const brColor = ['rgba(255,99,132,1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'];
</script>
{{-- end chart styling --}}

{{-- Debit Data --}}
<script>
    $(document).ready(function(){
        const chartColor = []

        let debitData = {}

        const getDebitData = async () => {
            await
            $.ajax({
                type:'GET',
                url:`/api/debit-data`,
                success:(response) => {
                    // console.log(response);
                    debitData = response
                },
                error:(e) =>{
                    console.log(e);
                }
            });
        }
        
        getDebitData().then(response => {
            let bgcolor = [];
            let brcolor = [];

            for (let index = 0; index < debitData.debit.length; index++) {
                let rand = Math.floor(Math.random() * bgColor.length);
                bgcolor = [...bgcolor, bgColor[rand]];
                brcolor = [...brcolor, brColor[rand]];
            }
            var barData = {
                labels: debitData.date,
                    datasets: [{
                        label: `Debet bulan ${debitData.Month}`,
                        backgroundColor: bgcolor,
                        borderColor: brcolor,
                        borderWidth: 1,
                        data: [...debitData.debit, 0]
                    }]
            };

            var myBarChart = new Chart($('#debitData'), {
                type: 'bar',
                data: barData,
                options: {
                    scales: {
                        y:{
                            display: true,
                            title: {
                                display: true,
                                text: 'Debet',
                                color: legendText.color,
                                font: legendText.font
                            }
                        },
                        x:{
                            display: true,
                            title: {
                                display: true,
                                text: 'Tanggal',
                                color: legendText.color,
                                font: legendText.font
                            }
                        },
                    }
                }
            });  
        })
    })

</script>
{{-- end fetch Debit Data --}}


{{-- Credit Data --}}
<script>
    $(document).ready(function(){
        const chartColor = []

        let data = {}

        const getDebitData = async () => {
            await
            $.ajax({
                type:'GET',
                url:`/api/credit-data`,
                success:(response) => {
                    // console.log(response);
                    data = response
                },
                error:(e) =>{
                    console.log(e);
                }
            });
        }
        
        getDebitData().then(response => {
            let bgcolor = [];
            let brcolor = [];

            for (let index = 0; index < data.credit.length; index++) {
                let rand = Math.floor(Math.random() * bgColor.length);
                bgcolor = [...bgcolor, bgColor[rand]];
                brcolor = [...brcolor, brColor[rand]];
            }
            var barData = {
                labels: data.date,
                    datasets: [{
                        label: `Kredit bulan ${data.Month}`,
                        backgroundColor: bgcolor,
                        borderColor: brcolor,
                        borderWidth: 1,
                        data: [...data.credit, 0]
                    }]
            };

            var myBarChart = new Chart($('#creditData'), {
                type: 'bar',
                data: barData,
                options: {
                    scales: {
                        y:{
                            display: true,
                            title: {
                                display: true,
                                text: 'Kredit',
                                color: legendText.color,
                                font: legendText.font
                            }
                        },
                        x:{
                            display: true,
                            title: {
                                display: true,
                                text: 'Tanggal',
                                color: legendText.color,
                                font: legendText.font
                            }
                        },
                    }
                }
            });  
        })
    })

</script>
{{-- end fetch Credit Data --}}

{{-- Balance Data --}}
<script>
    $(document).ready(function(){
        const chartColor = []

        let balanceData = {}

        const getDebitData = async () => {
            await
            $.ajax({
                type:'GET',
                url:`/api/balance-data`,
                success:(response) => {
                    balanceData = response
                },
                error:(e) =>{
                    console.log(e);
                }
            });
        }
        
        getDebitData().then(response => {
            let bgcolor = [];
            let brcolor = [];
            // console.log(balanceData.balance.length);

            for (let index = 0; index < balanceData.balance.length; index++) {
                
                let rand = Math.floor(Math.random() * bgColor.length);
                bgcolor = [...bgcolor, bgColor[rand]];
                brcolor = [...brcolor, brColor[rand]];
            }
            var barData = {
                labels: balanceData.date,
                    datasets: [{
                        label: `Kredit bulan ${balanceData.Month}`,
                        backgroundColor: bgcolor,
                        borderColor: brcolor,
                        borderWidth: 1,
                        data: [...balanceData.balance, 0]
                    }]
            };

            var myBarChart = new Chart($('#balanceData'), {
                type: 'bar',
                data: barData,
                options: {
                    scales: {
                        y:{
                            display: true,
                            title: {
                                display: true,
                                text: 'Kredit',
                                color: legendText.color,
                                font: legendText.font
                            }
                        },
                        x:{
                            display: true,
                            title: {
                                display: true,
                                text: 'Tanggal',
                                color: legendText.color,
                                font: legendText.font
                            }
                        },
                    }
                }
            });  
        })
    })

</script>
{{-- end fetch Balance Data --}}

@endsection