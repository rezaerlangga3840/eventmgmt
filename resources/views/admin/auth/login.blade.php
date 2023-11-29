@extends('admin.auth.main')
@section('pagetitle')
Login
@endsection
@section('boxtitle')
Sign in to start your session
@endsection
@section('form')
<form method="post" action="{{route('admin.authenticate')}}">
  @csrf
  <div class="input-group mb-3">
    <input type="email" class="form-control" placeholder="Email" name="email">
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-envelope"></span>
      </div>
    </div>
  </div>
  @error('email')
  <small style="color:red">{{$message}}</small>
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
  <small style="color:red">{{$message}}</small>
  @enderror
  <div class="row">
    <!-- /.col -->
    <div class="col-4">
      <button type="submit" class="btn btn-primary btn-block">Sign In</button>
    </div>
    <div class="col-4">
      <a href="{{route('front.home')}}" class="btn btn-primary">Batal</a>
    </div>
    
    <!-- /.col -->
  </div>
  <div class="row">
    <div class="col-12">
      <a href="{{route('admin.register')}}">Anggota baru</a>
    </div>
  </div>
</form>
@endsection