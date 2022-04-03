@extends('layouts.app')

@section('css')
{{-- datatable --}}
<link type="text/css" rel="stylesheet" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap.min.css') }}">

{{-- sweet alert --}}
<link rel="stylesheet" href="{{ asset('assets/vendor/sweet-alert/sweetalert2.min.css') }}">
@endsection

@section('content')
<x-header-content>
    Anggota
</x-header-content>

<div class="main-content bg-clouds">
    <div class="container-fluid p-t-15">
        <div class="box">
            <header>
                <h3>Data Anggota</h3>
                <div class="box-tools">
                    <a href="{{ route('member.create') }}" class="btn btn-flat btn-primary  u-posRelative"
                        style="color: white">Tambahkan Anggota</a>
                </div>
            </header>
            <div class="box-body">
                <table id="usersTable" class="table table-striped table-bordered dataTable " width="100%"
                    cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $member)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->email }}</td>
                                <td>{{ $member->phone }}</td>
                                <td style="display: flex; gap:5px">
                                    <a href="{{ route('member.edit',$member) }}" class="btn btn-flat btn-primary">Edit</a>
                                    <form action="{{ route('member.destroy',$member) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-flat btn-danger">Hapus</button>
                                    </form>
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
    $(document).ready(function () {
        $('.table').DataTable();
    });

    @if (session('success'))
        Swal.fire({
            text: "{{ session('success') }}",
            icon: 'success',
        })
    @endif
</script>

@endsection
