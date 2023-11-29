@extends('admin.master.main')
@section('bartitle')
Produk dalam kategori : {{$kategori->nama_kategori}}
@endsection
@section('pagetitle')
Produk dalam kategori : {{$kategori->nama_kategori}}
@endsection
@section('pagebreadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
<li class="breadcrumb-item"><a href="{{route('admin.kategori.daftar')}}">Kategori</a></li>
<li class="breadcrumb-item active">Produk dalam kategori : {{$kategori->nama_kategori}}</li>
@endsection
@section('pagecontent')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <a class="btn btn-sm btn-primary" href="{{route('admin.kategori.daftar')}}"><i class="fa fa-arrow-left"></i></a>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Produk</h3>
      </div>
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Status</th>
          </tr>
          </thead>
          <tbody>
            @foreach($produk as $prod)
              <tr>
                <td>{{$prod->nama_produk}}</td>
                <td>{{$prod->harga}}</td>
                <td>{{$prod->nama_status}}</td>
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
  @if(Session::has('added'))
    toastr.success("{{Session::get('added')}}")
  @endif
  @if(Session::has('updated'))
    toastr.success("{{Session::get('updated')}}")
  @endif
  @if(Session::has('deleted'))
    toastr.success("{{Session::get('deleted')}}")
  @endif
</script>
@endsection