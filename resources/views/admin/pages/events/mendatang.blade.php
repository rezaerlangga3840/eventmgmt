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
                  <!--modal edit-->
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