@extends('layouts.app')

@section('content')
<x-header-content>
    <a href="{{ route('member.index') }}">Anggota</a> / Edit Anggota
</x-header-content>

<div class="main-content bg-clouds">
    <div class="container-fluid p-t-15">
        <div class="column bg-white is-flexible shadow-2dp ps">
            <div class="box">
                <header class="bg-wet-asphalt text-white">
                    <h4>Form Edit Anggota</h4>
                    <!-- begin box-tools -->
                    <div class="box-tools">
                        <a class="fa fa-fw fa-minus" href="#" data-box="collapse"></a>
                        {{-- <a class="fa fa-fw fa-times" href="#" data-box="close"></a> --}}
                    </div>
                    <!-- END: box-tools -->
                </header>
                <div class="box-body collapse in">
                    <form action="{{ route('member.update',$member) }}" method="POST" style="margin: 0 auto; width:40%">
                        @csrf
                        @method('PUT')
                        <div class="form-group col-md-12">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control @error('name') input-error @enderror" id="name"
                                name="name" value="{{ $member->name }}" placeholder="Masukkan nama pengguna baru">
                            @error('name')
                            <label class="label-error" for="name">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') input-error @enderror" id="email"
                                name="email" value="{{ $member->email }}" placeholder="Masukkan email pengguna baru">
                            @error('email')
                            <label class="label-error" for="email">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <label for="phone">Nomor Telepone/HP</label>
                            <input type="text" class="form-control @error('phone') input-error @enderror" id="phone" name="phone" value="{{ $member->phone }}" placeholder="Masukkan nomor telepone/HP">
                            @error('phone')
                            <label class="label-error" for="phone">{{ $message }}</label>
                            @enderror
                        </div>


                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-flat btn-primary  u-posRelative">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
