@extends('layout.master')


@section('header')
<link rel="stylesheet" type="text/css" href="{{('/admin/assets/vendor/datatables/DataTables-1.10.21/css/dataTables.bootstrap4.min.css')}}">

@endsection

@section('content')


<div class="main">
  <div class="main-content">
    <div class="container-fluid">
        <div class="row">
           <div class="col-md-12">
              <div class="panel">

                <div class="panel-heading">
                  <h1 class="panel-title">Data Penjualan</h1>
                  <div class="right">
                    <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i class="lnr lnr-plus-circle btn btn-primary"> Tambah Data Penjualan</i></button>
                  </div>
                </div>
                <!-- end panel heading -->

                  <div class="panel-body">
                      <table id="mytable" class="table table-hover">
                        <thead>
                          <tr>
                            <th>Status</th>
                            <th>No Faktur</th>
                            <th>Nama Customer</th>
                            <th>Tanggal Jual</th>
                            <th>Jatuh Tempo</th>
                            <th>Catatan</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($data_jual as $jual)
                          <?php 
                            $auto = str_pad($jual['id'],4,0,STR_PAD_LEFT);
                            $tgl_jual = date("d/m/Y", strtotime($jual->tanggal_jual));
                            $tgl_tempo = date("d/m/Y", strtotime($jual->tanggal_tempo));
                          ?>
                            @if($jual->status_id == '2')
                              
                            @else
                            <tr>
                              <td><span class="label label-warning"><strong>{{$jual->status->nama_status}}</strong></span></td>
                              <td>{{$jual->faktur_no}}-{{$auto}}</td>
                              <td>{{$jual->customer->nama_cust}}</td>
                              <td>{{$tgl_jual}}</td>
                              <td><strong>{{$tgl_tempo}}</strong></td>
                              <td>{{$jual->note}}</td>
                              <td>
                                <a href="/detailjual/{{$jual->id}}" class="lnr lnr-file-add btn btn-info btn-sm"></a>
                                <a href="/jual/{{$jual->id}}/edit" class="lnr lnr-pencil btn btn-warning btn-sm"></a>
                                <a href="#" class="lnr lnr-trash btn btn-danger btn-sm hapus" 
                                  juals-id="{{$jual->id}}"></a>
                              </td>
                            </tr>
                            @endif
                          @endforeach
                        </tbody>
                      </table>      
                  </div>
                  <!-- End panel body -->
              </div>
              <!-- end panel -->
           </div>
           <!-- end col -->
        </div>
        <!-- end row out-->
    </div>
  </div>
</div>
<!-- end main -->

<!-- modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Penjualan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <div class="modal-body">
          <form action="\jual\store" method="POST">
              {{csrf_field()}}

              <input name="faktur_no" type="hidden" class="form-control" value="MAM.{{ $f_tgl }}">
              <div class="form-group">
                  <label>Customer</label>
                <select name="customer_id" class="form-control" required="">
                  <option value="">--pilih--</option>
                @foreach($data_cust as $cust)
                    <option value="{{$cust->id}}"{{(old('customer_id') == $cust->id) ? 'selected' : ''}}>{{$cust->nama_cust}}</option>
                  @endforeach
                  </select>
              </div>

              <div class="row">
                <!-- Left -->
                <div class="col-md-6">
                  <div class="form-group{{$errors->has('tanggal_jual') ? 'has-error' : ''}}">
                      <label>Tanggal Jual</label>
                        <input data-date-format='yyyy-mm-dd' name="tanggal_jual" type="date" class="form-control datepicker" autocomplete="off" value="{{ $tgl }}">
                  </div>
                </div>
                <!-- Right -->
                <div class="col-md-6">
                  <div class="form-group{{$errors->has('tanggal_tempo') ? 'has-error' : ''}}">
                      <label>Jatuh Tempo</label>
                        <input data-date-format='yyyy-mm-dd' name="tanggal_tempo" type="date" class="form-control datepicker" autocomplete="off" value="{{ $tgl }}">
                  </div>
                </div>
              </div>

              <div class="form-group">
                  <label>Sales</label>
                <select name="sales_id" class="form-control" required="">
                  <option value="">--pilih--</option>
                @foreach($data_sales as $sal)
                    <option value="{{$sal->id}}"{{(old('sales_id') == $sal->id) ? 'selected' : ''}}>{{$sal->nama_sales}}</option>
                  @endforeach
                  </select>
              </div>
              <div class="form-group">
                  <label>Catatan</label>
                  <textarea name="note" class="form-control" rows="2" placeholder="catatan" >{{old('note')}}</textarea>
              </div>
        </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
          </form>
      </div>
    </div>
  </div>
</div>
<!-- end modal -->

@endsection

@section('footer')

<script type="text/javascript" src="{{('/admin/assets/vendor/datatables/DataTables-1.10.21/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{('/admin/assets/vendor/datatables/DataTables-1.10.21/js/dataTables.bootstrap4.min.js')}}"></script>
  
<script>
  $(document).ready(function(){
    $('#mytable').DataTable();
  });

  // swal hapus
  $('.hapus').click(function(){
    var juals_id = $(this).attr('juals-id');
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-primary'
      },
      buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
      title: 'Yakin Ingin Menghapus?',
      text: "Tekan Dimana Saja Untuk Membatalkan",
      icon: 'warning',
      showCancelButton: false,
      confirmButtonText: 'Ya, Hapus',
      reverseButtons: false
    })
    .then((result) => {
      if (result.dismiss === Swal.DismissReason.backdrop) {
        swalWithBootstrapButtons.fire(
          'Cancel',
          'Data Tidak Dihapus',
          'error'
        )
      } else if (result) {
        window.location = "/jual/"+juals_id+"/delete"
        // swalWithBootstrapButtons.fire(
       //    'Deleted!',
       //    'Your file has been deleted.',
       //    'success'
       //  )
      }
    })
  });
</script>
@endsection