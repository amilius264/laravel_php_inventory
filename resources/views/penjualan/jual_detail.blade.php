@extends('layout.master')


@section('header')
<link rel="stylesheet" type="text/css" href="{{('/admin/assets/vendor/datatables/DataTables-1.10.21/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">

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
                        <th colspan="8">
                          <div class="input-group">
                            <span class="input-group-addon"><img src="../../admin/assets/img/favicon.png"></span>
                              <h2>CV ABCD</h2>
                              <p>Jl. Sapta Marga Ruko Kelapa Kembar No.2 Rt.15 Rw.03 Kel. Bukit Sangkal <br>
                              Kec. Kalidoni Kota Palembang Telp : 0821 8040 0406</p>
                              <h2 class="right">Nota Penjualan</h2>
                          </div>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td rowspan="2" colspan="5">
                          <strong>Nama Customer :</strong> <br>
                          {{$data_jual->customer->nama_cust}}
                          <p>{{$data_jual->customer->alamat}}</p>
                          {{$data_jual->customer->kontak}}
                          <input type="hidden" name="jual_id[]" value="{{$data_jual->id}}">
                        </td>
                        <td colspan="2" style="text-align: center;">
                          <strong>{{$data_jual->faktur_no}}-{{$auto}}</strong>
                          <tr>
                            <td colspan="2">
                            Tanggal Jual  <br>
                            Jatuh Tempo  <br>
                            Status
                            </td>
                            <td>
                              {{$tgl_jual}}<br>
                              <strong>{{$tgl_tempo}}</strong><br>
                              <span class="label label-warning"><strong>{{$data_jual->status->nama_status}}</strong></span>
                            </td>
                          </tr>
                        </td>
                      </tr>
                      <form method="POST" >
                        @csrf
                        {{ method_field('PUT') }}
                        <thead>
                      <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>QTY</th>
                            <th>Satuan</th>
                            <th>Harga</th>
                            <th>Diskon</th>
                            <th>Total</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $no=1; 
                            $total_qty=0;
                            $total_beli=0;
                          ?>
                        @if(count($data_jual->details) == 0)
                            <tr>
                                <td colspan="9"><center><h1> No Data</h1></center></td>
                            </tr>
                            @else
                        @foreach($data_jual->details as $detail)
                        <?php
                          $total_beli += $detail->total;
                        ?>
                        <tr>
                          <td><?php echo $no; $no++; ?></td>
                          <td>{{$detail->barang->nama_brg}}</td>
                          <td class="col-sm-1">
                            <input type="hidden" name="jualdetail_id[]" value="{{$detail->id}}">
                            <input type="hidden" name="barang_id[]" value="{{$detail->barang_id}}">
                            <input name="qty[]" type="number" class="form-control" required="" value="{{$detail->qty}}">
                          </td>
                          <td>{{$detail->satuan->nama_sat}}</td>
                          <td class="col-md-2">  
                            <div class="input-group">
                              <span class="input-group-addon">Rp</span>
                              <input name="price[]" type="number" class="form-control" value="{{$detail->price}}" required>
                            </div>
                          </td>
                          <td class="col-md-2">  
                            <div class="input-group">
                              <span class="input-group-addon">Rp</span>
                              <input name="disc[]" type="number" class="form-control" value="{{$detail->disc}}">
                            </div>
                          </td>
                          <td>
                            Rp {{number_format($detail->total,0,'.','.')}}
                          </td>
                          <td>
                            <!-- <a href="/detail/{{$detail->id}}/delete" class="lnr lnr-trash btn btn-danger btn-sm" onclick="return confirm('Yakin mau menghapus ?')"></a> -->
                            <a href="#" class="lnr lnr-trash btn btn-danger btn-sm hapus" 
                              dtl-id="{{$detail->id}}"> Hapus</a>
                          </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                  </table>

                  <table class="table table-responsive" cellspacing="0" cellpadding="0">
                    <tr>
                      <td colspan="4">
                        <b><i>Catatan :</b> {{$data_jual->note}}</i>
                      </td>
                      <td>
                        <i>Jumlah</i>
                      </td>
                      <td name="total_beli">
                        <b>Rp {{number_format($total_beli,0,'.','.')}}</b>
                      </td>
                    </tr>
                    <tbody>
                      <tr>
                        <td colspan=4></td>
                        <td>
                          PPN 10%
                        </td>
                        <td class="col-md-2">
                          <div class="input-group">
                            <span class="input-group-addon">Rp</span>
                            <input name="ppn" type="number" class="form-control" value="{{$data_jual->ppn}}">
                          </div>
                        </td>
                      </tr>
                      <?php 
                        $total_byr = $total_beli + $data_jual->ppn;
                      ?>
                      <tr>
                        <td>Tanda Terima</td>
                        <td>Pengirim</td>
                        <td colspan="2"><span style="color: white;">xxx</span>Salesman</td>
                        <th>Total Bayar</th>
                        <th name="total_s">
                          <!-- <input name="total_s" type="text" class="form-control" value="{{$total_byr}}" disabled=""> -->
                          Rp {{number_format($total_byr,0,'.','.')}}
                        </th>
                      </tr>
                      <tr><td rowspan="6"></td></tr>
                      <tr><td rowspan="6"></td></tr>
                      <tr>
                        <td rowspan="2">
                          <p style="color: white;">xxxxx</p>
                          <p style="color: white;">xxxxx</p>
                          {{$data_jual->sales->nama_sales}}
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div>
                    <div class="panel-body"></div>
                  </div>
                        <div>
                          @if(count($data_jual->details) == 0)
                          <button type="button" data-toggle="modal" data-target="#addModal" class="lnr lnr-plus-circle btn btn-primary"> Tambah Detail Penjualan</button>
                          <button type="button" class="lnr lnr-bookmark btn btn-success float-right" data-toggle="modal" data-target="#finish"> Terima Barang</button>
                          <button type="button" class="lnr lnr-arrow-left-circle btn btn-secondary"><a href="/jual"> Kembali</a></button>
                          @else
                          <button type="submit" class="lnr lnr-pencil btn btn-warning btn-toastr" data-context="warning" data-message="This is warning info" data-position="top-right" ></button>
                          <button type="button" data-toggle="modal" data-target="#addModal" class="lnr lnr-plus-circle btn btn-primary"> Tambah Detail Penjualan</button>
                          <button type="button" class="lnr lnr-bookmark btn btn-success float-right" data-toggle="modal" data-target="#finish"> Terima Barang</button>
                          <button type="button" class="lnr lnr-arrow-left-circle btn btn-secondary"><a href="/jual"> Kembali</a></button>
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


@include('penjualan.addmodal_detail')
@include('penjualan.caribrg')

@endsection

@section('footer')

<script type="text/javascript" src="{{('/admin/assets/vendor/datatables/DataTables-1.10.21/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{('/admin/assets/vendor/datatables/DataTables-1.10.21/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

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
        window.location = "/detailjual/"+dtl_id+"/delete"
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