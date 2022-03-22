@extends('layouts.app')

@section('content')
<x-header-content>
    Keuangan
</x-header-content>

<div class="main-content bg-clouds">
    <div class="container-fluid p-t-15">
        <div style="display: flex; justify-content:center; gap:100px; text-align:center">
            @foreach ($accounts as $item)
                <a href="{{ url('finance/index/'.Str::slug($item->title)) }}" class="card-title btn btn-success m-t-15 m-b-4" style="width: 100%; font-size:3rem;">{{ $item->title }}</a>
            @endforeach
        </div>
    </div>
</div>
@endsection
