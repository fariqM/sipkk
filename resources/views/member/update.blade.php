@extends('layouts.app')

@section('content')
<x-header-content>
    <a href="/event/index">Kegiatan</a> / Tambah Kegiatan
</x-header-content>

<div class="main-content bg-clouds">
    <div class="container-fluid p-t-15">
        <div class="column bg-white is-flexible shadow-2dp ps">
            <div class="box">
                <header class="bg-wet-asphalt text-white">
                    <h4>Form Kegiatan</h4>
                    <!-- begin box-tools -->
                    <div class="box-tools">
                        <a class="fa fa-fw fa-minus" href="#" data-box="collapse"></a>
                        {{-- <a class="fa fa-fw fa-times" href="#" data-box="close"></a> --}}
                    </div>
                    <!-- END: box-tools -->
                </header>
                <div class="box-body collapse in">
                    <form action="{{ route('user.update', ['user' => $user->id]) }}" method="POST" style="margin: 0 auto; width:40%">
                        @csrf

                        <div class="form-group col-md-12 ">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control @error('name') input-error @enderror" id="name"
                                name="name" value="{{ old('name') ? old('name') : $user->name }}" placeholder="Masukkan nama pengguna baru">
                            @error('name')
                            <label class="label-error" for="name">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group col-md-12 ">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') input-error @enderror"
                                    id="password" name="password" value=""
                                    placeholder="Masukkan password baru *Opsional">
                                <span class="input-group-addon" id="cp1" onclick="showPassword()" style="cursor: pointer;">
                                    <i class="fa fa-fw fa-eye-slash" id="passwordIcon"></i>
                                </span>
                            </div>

                            @error('password')
                            <label class="label-error" for="password">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group col-md-12 ">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password_confirmation') input-error @enderror"
                                    id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}"
                                    placeholder="Ulangi password jika ingin merubah password lama">
                                <span class="input-group-addon" id="cp1" onclick="showPasswordConf()" style="cursor: pointer;">
                                    <i class="fa fa-fw fa-eye-slash" id="passwordIcon2"></i>
                                </span>
                            </div>

                            @error('password_confirmation')
                            <label class="label-error" for="password_confirmation">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group col-md-12 ">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') input-error @enderror" id="email"
                                name="email" value="{{ old('email') ? old('email') : $user->email }}" placeholder="Masukkan email pengguna baru">
                            @error('email')
                            <label class="label-error" for="email">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group col-md-12 ">
                            <label for="role">Jabatan</label>
                            <div>
                                <select class="form-control @error('role') input-error @enderror" id="role" name="role">
                                    <option value="" disabled selected>Pilih Jabatan</option>
                                    @foreach ($roles as $item)
                                    @if (old('role') == $item->name || $user->hasRole($item->name))
                                    <option value="{{  $item->name }}" selected>{{ $item->name }}</option>
                                    @else
                                    <option value="{{  $item->name }}">{{ $item->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            @error('role')
                            <label class="label-error" for="category">{{ $message }}</label>
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


@section('js')
<script>
    const input = document.getElementById("password");
    const icon = document.getElementById("passwordIcon");

    const input2 = document.getElementById("password_confirmation");
    const icon2 = document.getElementById("passwordIcon2");

    function showPassword(){
        if (input.type == 'text') {
            icon.classList.remove("fa-eye")
            icon.classList.add("fa-eye-slash")
            input.type = 'password'
        } else {
            icon.classList.remove("fa-eye-slash")
            icon.classList.add("fa-eye")
            input.type = 'text'
        }
    }

    function showPasswordConf(){
        if (input2.type == 'text') {
            icon2.classList.remove("fa-eye")
            icon2.classList.add("fa-eye-slash")
            input2.type = 'password'
        } else {
            icon2.classList.remove("fa-eye-slash")
            icon2.classList.add("fa-eye")
            input2.type = 'text'
        }
    }
</script>
@endsection
