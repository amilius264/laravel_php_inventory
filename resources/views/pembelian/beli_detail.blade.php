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
                <div class="panel-body">
                  <table class="table table-bordered table-responsive">
                    <thead>
                      <tr>
                        <th colspan="4">
                          <div class="input-group">
                            
                              <h2>Nota Pembelian</h2>
                          </div>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td rowspan="2" class="col-md-9">
                          <strong>Nama Supplier :</strong> <br>
                          {{$data_beli->suplier->nama_sup}}
                          <p>{{$data_beli->suplier->alamat}}</p>
                          {{$data_beli->suplier->kontak}}
                        </td>
                        <td colspan="2" style="text-align: center;">
                          <strong>{{$data_beli->noinv}}</strong>
                          <tr>
                            <td>
                            Tanggal Faktur  <br>
                            Status
                            </td>
                            <td>
                              {{$tgl_beli}}<br>
                              <!-- {{$data_beli->tanggal_beli}}<br> -->
                              @if(($data_beli->status) == '1')
                                <span class="label label-warning"><strong>PROSES</strong></span><br>
                              @else
                                <span class="label label-success"><strong>SELESAI</strong></span><br>
                              @endif
                            </td>
                          </tr>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                      <form method="POST" >
                        @csrf
                        {{ method_field('PUT') }}
                      <table id="table" class="table table-hover table-bordered">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>QTY</th>
                            <th>Satuan</th>
                            <th>Harga Beli</th>
                            <th>Diskon</th>
                            <th>PPN</th>
                            <th>Total</th>
                            @if($data_beli->status == 2)

                            @else
                            <th>Aksi</th>
                            @endif
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $no=1; 
                            $total_qty=0;
                            $total_beli=0;
                          ?>
                        @if(count($data_beli->lines) == 0)
                            <tr>
                                <td colspan="9"><center><h1> No Data</h1></center></td>
                            </tr>
                            @else
                        @foreach($data_beli->lines as $detail)
                        <?php
                          $total_beli += $detail->total;
                        ?>
                        <tr>
                          <td><?php echo $no; $no++; ?></td>
                          <td>{{$detail->barang->nama_brg}}</td>
                          <td class="col-sm-1">
                            <input type="hidden" name="belidetail_id[]" value="{{$detail->id}}">
                            <input type="hidden" name="barang_id[]" value="{{$detail->barang_id}}">
                            @if($data_beli->status == 2)
                            {{$detail->jumlah}}
                            @else
                            <input name="jumlah[]" type="number" class="form-control" required="" value="{{$detail->jumlah}}">
                            @endif
                          </td>
                          <td>{{$detail->satuan->nama_sat}}</td>
                          <td class="col-md-2">
                            @if($data_beli->status == 2)
                            Rp {{number_format($detail->price,0,'.','.')}}
                            @else
                            <div class="input-group">
                              <span class="input-group-addon">Rp</span>
                              <input name="price[]" type="number" class="form-control" value="{{$detail->price}}" required>
                            </div>
                            @endif
                          </td>
                          <td>
                            Rp {{number_format($detail->diskon,0,'.','.')}}
                          </td>
                          <td>
                            Rp {{number_format($detail->ppn,0,'.','.')}}
                          </td>
                          <td>
                            Rp {{number_format($detail->total,0,'.','.')}}
                          </td>
                            @if($data_beli->status == 2)
                            @else
                          <td>
                            
                            <!-- <a href="/detail/{{$detail->id}}/delete" class="lnr lnr-trash btn btn-danger btn-sm" onclick="return confirm('Yakin mau menghapus ?')"></a> -->
                            <a href="#" class="lnr lnr-trash btn btn-danger btn-sm hapus" 
                              dtl-id="{{$detail->id}}"> Hapus</a>
                            @endif
                          </td>
                        </tr>
                        @endforeach
                        @endif
                        </tbody>
                        <tfoot>
                          <tr>
                            <th colspan="6">
                              <b><i>Catatan :</b> {{$data_beli->note}}</i>
                            </th>
                            <th><b><i>Jumlah</i></b></th>
                            <th>
                              <b><i>Rp {{number_format($total_beli,0,'.','.')}}</i></b>
                            </th>
                            @if($data_beli->status == 2)
                            @else
                            <th></th>
                            @endif
                          </tr>
                        </tfoot>
                      </table>

                        <div>
                          @if(count($data_beli->lines) == 0)
                          <button type="button" data-toggle="modal" data-target="#addModal" class="lnr lnr-plus-circle btn btn-primary"> Tambah Detail Penjualan</button>
                          <button type="button" class="lnr lnr-bookmark btn btn-success float-right" data-toggle="modal" data-target="#finish"> Terima Barang</button>
                          <button type="button" class="lnr lnr-arrow-left-circle btn btn-secondary"><a href="/jual"> Kembali</a></button>
                          @else
                          
                          <button type="submit" class="lnr lnr-pencil btn btn-warning btn-toastr" data-context="warning" data-message="This is warning info" data-position="top-right" > Ubah</button>
                          <button type="button" data-toggle="modal" data-target="#addModal" class="lnr lnr-plus-circle btn btn-primary"> Tambah Detail Pembelian</button>
                          <button type="button" class="lnr lnr-bookmark btn btn-success float-right" data-toggle="modal" data-target="#finish"> Terima Barang</button>
                          <button type="button" class="lnr lnr-arrow-left-circle btn btn-secondary"><a href="/beli"> Kembali</a></button>
                          @endif
                        </div>
                      </form>
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


@include('pembelian.addmodal_detail')
@include('pembelian.caribrg')

@endsection

@section('footer')

<script type="text/javascript" src="{{('/admin/assets/vendor/datatables/DataTables-1.10.21/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{('/admin/assets/vendor/datatables/DataTables-1.10.21/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="../../plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../../plugins/jquery-validation/additional-methods.min.js"></script>

<script>  
  $(document).ready(function(){
    $('#mytable').DataTable();
  });

  $(document).ready(function(){
    $(document).on('click', '#select', function() {
      var id = $(this).data('id');
      var nama_brg = $(this).data('nama');
      var satuan_id = $(this).data('satuan_id');
      var satuan = $(this).data('satuan');
      var harga = $(this).data('harga');
      $('#id').val(id);
      $('#nama_brg').val(nama_brg);
      $('#satuan_id').val(satuan_id);
      $('#satuan').val(satuan);
      $('#harga').val(harga);
      $('#modal-item').modal('hide');
    })
  });

  // swal hapus
  $('.hapus').click(function(){
    var dtl_id = $(this).attr('dtl-id');
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
        window.location = "/detail/"+dtl_id+"/delete"
        // swalWithBootstrapButtons.fire(
       //    'Deleted!',
       //    'Your file has been deleted.',
       //    'success'
       //  )
      }
    })
  });

  $(document).ready(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      alert( "Form successful submitted!" );
    }
  });

  $('#quickForm').validate({
    rules: {
      nama_brg: {
        required: true
      }
    },
    messages: {
      nama_brg: {
        required: "Pilih Barang"
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
@endsection