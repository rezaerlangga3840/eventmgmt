@extends('admin.master.main')
@section('bartitle','Produk')
@section('pagetitle')
Produk
@endsection
@section('pagebreadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
<li class="breadcrumb-item active">Produk</li>
@endsection
@section('pagecontent')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i></button>
      </div>
      <form action="{{route('admin.produk.save')}}" enctype="multipart/form-data" method="post"><!--route('admin.team_profile.save')-->
        <div class="modal fade" id="addModal">
          <div class="modal-dialog">
            <div class="modal-content bg-primary">
              <div class="modal-header">
                <h4 class="modal-title">Tambah Produk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                @csrf
                <div class="form-group">
                  <label for="nama_produk">Nama Produk</label>
                  <input type="text" name="nama_produk" class="form-control" id="nama_produk" placeholder="Misal : Aluminium">
                </div>
                <div class="form-group">
                  <label for="harga">Harga Produk</label>
                  <input type="number" name="harga" class="form-control" id="harga">
                </div>
                <div class="form-group">
                  <label for="kategori_id">Kategori</label>
                  <select name="kategori_id" class="form-control" id="kategori_id">
                    @foreach($kategori as $kat)
                    <option value="{{$kat->id_kategori}}">{{$kat->nama_kategori}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="status_id">Status</label>
                  <select name="status_id" class="form-control" id="status_id">
                    @foreach($status as $sta)
                    <option value="{{$sta->id_status}}">{{$sta->nama_status}}</option>
                    @endforeach
                  </select>
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
        <h3 class="card-title">Daftar Produk</h3>
      </div>
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Kategori</th>
            <th>Status</th>
            <th>Opsi</th>
          </tr>
          </thead>
          <tbody>
            @foreach($produk as $prod)
              <tr>
                <td>{{$prod->nama_produk}}</td>
                <td>{{$prod->harga}}</td>
                <td>{{$prod->nama_kategori}}</td>
                <td>{{$prod->nama_status}}</td>
                <td>
                  <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit_produk_{{ $prod->id_produk }}"><i class="fa fa-edit"></i></button>
                  <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_produk_{{ $prod->id_produk }}"><i class="fa fa-trash"></i></button>
                  <!--modal edit-->
                  <form action="{{route('admin.produk.update',['id_produk'=>$prod->id_produk])}}" enctype="multipart/form-data" method="post">
                    <div class="modal fade" id="edit_produk_{{ $prod->id_produk }}">
                      <div class="modal-dialog">
                        <div class="modal-content bg-primary">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Produk</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            @csrf
                            {{method_field('PUT')}}
                            <div class="form-group">
                              <label for="nama_produk">Nama Produk</label>
                              <input type="text" name="nama_produk" value="{{ $prod->nama_produk }}" class="form-control" id="nama_produk" placeholder="Misal : Aluminium">
                            </div>
                            <div class="form-group">
                              <label for="harga">Harga Produk</label>
                              <input type="number" name="harga" value="{{ $prod->harga }}" class="form-control" id="harga">
                            </div>
                            <div class="form-group">
                              <label for="kategori_id">Kategori</label>
                              <select name="kategori_id" class="form-control" id="kategori_id">
                                @foreach($kategori as $kat)
                                <option {{ ($prod->kategori_id==$kat->id_kategori?"selected='selected'":"") }} value="{{$kat->id_kategori}}">{{$kat->nama_kategori}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="status_id">Status</label>
                              <select name="status_id" class="form-control" id="status_id">
                                @foreach($status as $sta)
                                <option {{ ($prod->status_id==$sta->id_status?"selected='selected'":"") }} value="{{$sta->id_status}}">{{$sta->nama_status}}</option>
                                @endforeach
                              </select>
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
                  <form method="POST" action="{{route('admin.produk.delete',['id_produk'=>$prod->id_produk])}}">
                    <div class="modal fade" id="hapus_produk_{{$prod->id_produk}}">
                      <div class="modal-dialog">
                        <div class="modal-content bg-danger">
                          <div class="modal-header">
                            <h4 class="modal-title">Peringatan!</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p>Yakin ingin hapus Produk ini?</p>
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