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
                  <h1 class="panel-title">Data Pembelian</h1>
                  <div class="right">
                    <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i class="lnr lnr-plus-circle btn btn-primary"> Tambah Data Pembelian</i></button>
                  </div>
                </div>
                <!-- end panel heading -->

                  <div class="panel-body">
                      <table id="mytable" class="table table-hover">
                        <thead>
                          <tr>
                            <th>Status</th>
                            <th>No Invoice</th>
                            <th>Nama Supplier</th>
                            <th>Tanggal Beli</th>
                            <th>Catatan</th>
                            <th>Jumlah Barang</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                        
                        @if(count($data_beli) == 0)
                            <tr>
                                <td colspan="8"><center><h1> No Data</h1></center></td>
                            </tr>
                            @else
                          @foreach($data_beli as $beli)
                          <?php
                            $tgl_beli = date("d/m/Y", strtotime($beli->tanggal_beli));
                          ?>
                              @if($beli->status == '2')
                              
                              @else
                            <tr>
                              <td><span class="label label-warning"><strong>PROSES</strong></span></td>
                              <td>{{$beli->noinv}}</td>
                              <td>{{$beli->suplier->nama_sup}}</td>
                              <td>{{$tgl_beli}}</td>
                              <td>{{$beli->note}}</td>
                              <td>{{$beli->lines_count}}</td>
                              <!-- <td>Rp {{number_format($beli->total(),0,'.','.')}}</td> -->
                              <td>
                                <a href="/detailbeli/{{$beli->id}}" class="lnr lnr-file-add btn btn-info btn-sm"></a>
                                <a href="/beli/{{$beli->id}}/edit" class="lnr lnr-pencil btn btn-warning btn-sm"></a>
                                <!-- <a href="/beli/{{$beli->id}}/delete" class="lnr lnr-trash btn btn-danger btn-sm" onclick="return confirm('Yakin mau menghapus ?')"></a> -->
                                <a href="#" class="lnr lnr-trash btn btn-danger btn-sm hapus" 
                                  bali-id="{{$beli->id}}"></a>
                              </td>
                            </tr>
                              @endif
                          @endforeach
                        @endif
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Pembelian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <div class="modal-body">
          <form action="\beli\store" method="POST">
              {{csrf_field()}}
              <div class="form-group{{$errors->has('no_inv') ? 'has-error' : ''}}" >
                <label>No Invoice <span style="color: red">*</span></label>
                <input name="noinv" type="text" class="form-control" placeholder="No Invoice" required="" value="{{old('noinv')}}">
                @if($errors->has('noinv'))
                  <span class="help-block with-errors">{{$errors->first('noinv')}}</span>
                @endif
              </div>
              <div class="form-group">
                  <label>Supplier <span style="color: red">*</span></label>
                <select name="suplier_id" class="form-control" required="">
                  <option value="">--pilih--</option>
                @foreach($data_sup as $sup)
                    <option value="{{$sup->id}}"{{(old('suplier_id') == $sup->id) ? 'selected' : ''}}>{{$sup->nama_sup}}</option>
                  @endforeach
                  </select>
              </div>
              <div class="form-group{{$errors->has('tanggal') ? 'has-error' : ''}}">
                  <label>Tanggal <span style="color: red">*</span></label>
                  <input data-date-format='yyyy-mm-dd' name="tanggal_beli" type="date" class="form-control datepicker" autocomplete="off" value="{{ $tgl }}">
                  <!-- <input data-date-format='yyyy-mm-dd' name="tanggal" type="date" autocomplete="off" class="form-control datepicker" required="" value="{{old('tanggal')}}"> -->
              </div>
              <div class="form-group">
                  <label>Catatan</label>
                  <textarea name="note" class="form-control" rows="2" placeholder="catatan" >{{old('note')}}</textarea>
              </div>
              <h6 style="color: red">(*) Harus Diisi</h6>
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

  $('#reservationdate').datetimepicker({
        format: 'L'
  });
</script>

<script>
  // swal hapus
  $('.hapus').click(function(){
    var bali_id = $(this).attr('bali-id');
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
        window.location = "/beli/"+bali_id+"/delete"
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