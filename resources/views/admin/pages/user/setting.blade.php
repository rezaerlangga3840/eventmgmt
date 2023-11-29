@extends('admin.master.main')
@section('bartitle','User Setting')
@section('pagetitle')
User Setting
@endsection
@section('pagebreadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
<li class="breadcrumb-item active">User Setting</li>
@endsection
@section('pagecontent')
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title">Edit data pengguna</h5>
        </div>
        <form method="POST" action="{{ route('admin.usersettingupdate', ['id' => $user->id]) }}">
           @csrf
          {{ method_field('PUT') }}
          <div class="card-body">
            <div class="form-group">
              <label for="email">Alamat e-mail</label>
              <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="currentpassword">Password saat ini</label>
              <input type="password" class="form-control" id="currentpassword" name="currentpassword" placeholder="Masukkan password untuk perubahan data">
            </div>
            <div class="form-group">
              <label for="newpassword">Password baru</label>
              <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Kosongkan apabila tidak ada perubahan">
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('customscripts')
<script>
  @if(Session::has('wrongpassword'))
    toastr.error("{{Session::get('wrongpassword')}}")
  @endif
  @if(Session::has('mustdifferent'))
    toastr.error("{{Session::get('mustdifferent')}}")
  @endif
  @if(Session::has('successfullyupdate'))
    toastr.success("{{Session::get('successfullyupdate')}}")
  @endif
  @if(Session::has('successfullyupdatepassword'))
    toastr.success("{{Session::get('successfullyupdatepassword')}}")
  @endif
</script>
@endsection