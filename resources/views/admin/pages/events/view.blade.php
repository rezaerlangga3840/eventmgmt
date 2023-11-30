@extends('admin.master.main')
@section('bartitle')
Peserta event : {{$events->title}}
@endsection
@section('pagetitle')
Peserta event : {{$events->title}}
@endsection
@section('pagebreadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
<li class="breadcrumb-item"><a href="{{route('admin.events.daftar')}}">Daftar Event</a></li>
<li class="breadcrumb-item active">Peserta event : {{$events->title}}</li>
@endsection
@section('pagecontent')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <a class="btn btn-sm btn-primary" href="{{route('admin.events.daftar')}}"><i class="fa fa-arrow-left"></i></a>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <dl>
          <dt>Nama event</dt>
          <dd>{{$events->title}}</dd>
          <dt>Deskripsi</dt>
          <dd>{{$events->description}}</dd>
          <dt>Tanggal</dt>
          <dd>{{$events->date}}</dd>
          <dt>Waktu</dt>
          <dd>{{$events->time}}</dd>
          <dt>Lokasi</dt>
          <dd>{{$events->location}}</dd>
        </dl>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Peserta</h3>
      </div>
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Nama</th>
            <th>Email</th>
          </tr>
          </thead>
          <tbody>
            @foreach($bookings as $book)
              <tr>
                <td>{{$book->name}}</td>
                <td>{{$book->email}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
@section('customscripts')
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  
</script>
@endsection