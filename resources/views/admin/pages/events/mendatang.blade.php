@extends('admin.master.main')
@section('bartitle')
Event Mendatang
@endsection
@section('pagetitle')
Event Mendatang
@endsection
@section('pagebreadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
<li class="breadcrumb-item active">Event Mendatang</li>
@endsection
@section('pagecontent')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Event Mendatang</h3>
      </div>
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Tempat</th>
            <th>Slot</th>
            <th>Opsi</th>
          </tr>
          </thead>
          <tbody>
            @foreach($events as $ev)
              <tr>
                <td>{{$ev->title}}</td>
                <td>{{$ev->description}}</td>
                <td>{{$ev->date}}</td>
                <td>{{$ev->time}}</td>
                <td>{{$ev->location}}</td>
                <td>{{$ev->slots_available}}</td>
                <td>
                  @if(App\Models\bookings::where('event_id',$ev->id)->count() < $ev->slots_available)
                  @if(App\Models\bookings::where('user_id',Auth::user()->id)->where('event_id',$ev->id)->count()==0)
                  <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#booking_kursi_{{ $ev->id }}">Booking</button>
                  @else
                  Sudah dipesan
                  @endif
                  @else
                  Kursi penuh
                  @endif
                  
                  <form action="{{route('admin.events.booking',['id'=>$ev->id])}}" enctype="multipart/form-data" method="post">
                    <div class="modal fade" id="booking_kursi_{{ $ev->id }}">
                      <div class="modal-dialog">
                        <div class="modal-content bg-primary">
                          <div class="modal-header">
                            <h4 class="modal-title">Booking kursi</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p>Yakin ingin booking kursi di event ini?</p>
                            @csrf
                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Booking</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  <!--modal edit-->
                  @if($ev->created_by_user_id==Auth::user()->id)
                  <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit_event_{{ $ev->id }}"><i class="fa fa-edit"></i></button>
                  <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_event_{{ $ev->id }}"><i class="fa fa-trash"></i></button>
                  <!--modal edit-->
                  <form action="{{route('admin.events.update',['id'=>$ev->id])}}" enctype="multipart/form-data" method="post"><!---->
                    <div class="modal fade" id="edit_event_{{ $ev->id }}">
                      <div class="modal-dialog">
                        <div class="modal-content bg-primary">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Event</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            @csrf
                            {{method_field('PUT')}}
                            <div class="form-group">
                              <label for="title">Judul</label>
                              <input type="text" value="{{ $ev->title }}" name="title" class="form-control" id="title" placeholder="Misal : Pelatihan Masak">
                            </div>
                            <div class="form-group">
                              <label for="description">Deskripsi</label>
                              <textarea name="description" class="form-control" id="description" name="description">{{ $ev->description }}</textarea>
                            </div>
                            <div class="form-group">
                              <label for="date">Tanggal</label>
                              <input name="date" type="date" value="{{ $ev->date }}" id="date" class="form-control">
                            </div>
                            <div class="form-group">
                              <label for="time">Waktu</label>
                              <input name="time" type="time" value="{{ $ev->time }}" id="time" class="form-control">
                            </div>
                            <div class="form-group">
                              <label for="location">Tempat</label>
                              <input type="text" name="location" value="{{ $ev->location }}" class="form-control" id="location" placeholder="Misal : Restoran">
                            </div>
                            <div class="form-group">
                              <label for="slots_available">Slot</label>
                              <input type="number" name="slots_available" value="{{ $ev->slots_available }}" class="form-control" id="slots_available">
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
                  <form method="POST" action="{{route('admin.events.delete',['id'=>$ev->id])}}">
                    <div class="modal fade" id="hapus_event_{{$ev->id}}">
                      <div class="modal-dialog">
                        <div class="modal-content bg-danger">
                          <div class="modal-header">
                            <h4 class="modal-title">Peringatan!</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p>Yakin ingin hapus event ini?</p>
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
                  @endif
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
  $('#date').datetimepicker({
    locale: 'id',
    format: 'YYYY-MM-DD',
  });
  $('#time').datetimepicker({
    format: 'HH:mm:ss',
  });
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
  @if(Session::has('booked'))
    toastr.success("{{Session::get('booked')}}")
  @endif
</script>
@endsection