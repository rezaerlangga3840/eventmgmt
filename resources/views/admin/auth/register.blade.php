@extends('admin.auth.main')
@section('pagetitle')
Register
@endsection
@section('boxtitle')
Register to start your session
@endsection
@section('form')
<form method="POST" action="{{route('admin.registration')}}">
  @csrf
  <div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Nama" name="name">
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-user"></span>
      </div>
    </div>
  </div>
  @error('name')
  <small style="color:red">{{ $message }}</small>
  @enderror
  <div class="input-group mb-3">
    <input type="email" class="form-control" placeholder="Email" name="email">
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-envelope"></span>
      </div>
    </div>
  </div>
  @error('email')
  <small style="color:red">{{ $message }}</small>
  @enderror
  <div class="input-group mb-3">
    <input type="password" class="form-control" placeholder="Password" name="password">
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-lock"></span>
      </div>
    </div>
  </div>
  @error('password')
  <small style="color:red">{{ $message }}</small>
  @enderror
  <div class="input-group mb-3">
    <input type="password" class="form-control" placeholder="Konfirmasi Password" name="password_confirmation">
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-lock"></span>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-4">
      <button type="submit" class="btn btn-primary btn-block">Daftar</button>
    </div>
    <div class="col-8">
      <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <a href="{{route('admin.login')}}">Login ke akun yang sudah ada</a>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <a href="{{route('front.home')}}">Kembali ke halaman utama</a>
    </div>
  </div>
</form>

@endsection