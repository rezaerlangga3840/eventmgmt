@extends('admin.master.main')
@section('bartitle','Kategori')
@section('pagetitle')
Kategori
@endsection
@section('pagebreadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
<li class="breadcrumb-item active">Kategori</li>
@endsection
@section('pagecontent')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i></button>
      </div>
      <form action="{{route('admin.kategori.save')}}" enctype="multipart/form-data" method="post"><!--route('admin.team_profile.save')-->
        <div class="modal fade" id="addModal">
          <div class="modal-dialog">
            <div class="modal-content bg-primary">
              <div class="modal-header">
                <h4 class="modal-title">Tambah Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                @csrf
                <div class="form-group">
                  <label for="nama_kategori">Nama Kategori</label>
                  <input type="text" name="nama_kategori" class="form-control" id="nama_kategori" placeholder="Misal : Barang Pecah Belah">
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">Simpan</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Kategori</h3>
      </div>
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Nama Kategori</th>
            <th>Opsi</th>
          </tr>
          </thead>
          <tbody>
            @foreach($kategori as $kat)
              <tr>
                <td>{{$kat->nama_kategori}}</td>
                <td>
                  <a href="{{route('admin.kategori.lihatproduk',['id_kategori'=>$kat->id_kategori])}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                  <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit_kategori_{{ $kat->id_kategori }}"><i class="fa fa-edit"></i></button>
                  <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_kategori_{{ $kat->id_kategori }}"><i class="fa fa-trash"></i></button>
                  <!--modal edit-->
                  <form action="{{route('admin.kategori.update',['id_kategori'=>$kat->id_kategori])}}" enctype="multipart/form-data" method="post">
                    <div class="modal fade" id="edit_kategori_{{ $kat->id_kategori }}">
                      <div class="modal-dialog">
                        <div class="modal-content bg-primary">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Kategori</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            @csrf
                            {{method_field('PUT')}}
                            <div class="form-group">
                              <label for="nama_kategori">Nama Kategori</label>
                              <input type="text" name="nama_kategori" value="{{ $kat->nama_kategori }}" class="form-control" id="nama_kategori" placeholder="Misal : Barang Pecah Belah">
                            </div>
                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  <!--modal delete-->
                  <form method="POST" action="{{route('admin.kategori.delete',['id_kategori'=>$kat->id_kategori])}}">
                    <div class="modal fade" id="hapus_kategori_{{$kat->id_kategori}}">
                      <div class="modal-dialog">
                        <div class="modal-content bg-danger">
                          <div class="modal-header">
                            <h4 class="modal-title">Peringatan!</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p>Yakin ingin hapus kategori ini?</p>
                            @csrf
                            {{method_field('DELETE')}}
                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Ya, hapus</button>
                          </div>
                        </div>
                      </div>
                    </div>
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