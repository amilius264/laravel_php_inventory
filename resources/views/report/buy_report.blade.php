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
              <!-- @if(session('sukses'))
                <div class="alert alert-success fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close" data-context="success" data-position="top-right">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  {{session('sukses')}}
                </div>
              @endif -->
              <div class="panel">
                

                <div class="panel-heading">
                  <h1 class="panel-title">Data Pembelian</h1>
                </div>
                <!-- end panel heading -->

                  <div class="panel-body">
                      <table id="mytable" class="table table-hover table-bordered">
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
                              @if($beli->status == '1')
                              
                              @else
                            <tr>
                              <td><span class="label label-success"><strong>SELESAI</strong></span></td>
                              <td>{{$beli->noinv}}</td>
                              <td>{{$beli->suplier->nama_sup}}</td>
                              <td>{{$tgl_beli}}</td>
                              <td>{{$beli->note}}</td>
                              <td>{{$beli->lines_count}} Jenis Barang</td>
                              <td>
                                <a href="/detailbeli/{{$beli->id}}" class="lnr lnr-bookmark btn btn-info btn-sm"></a>
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





@endsection

@section('footer')

<script type="text/javascript" src="{{('/admin/assets/vendor/datatables/DataTables-1.10.21/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{('/admin/assets/vendor/datatables/DataTables-1.10.21/js/dataTables.bootstrap4.min.js')}}"></script>

<script>	
	$(document).ready(function(){
		$('#mytable').DataTable({
      "lengthChange": false,
      "searching": false,
      "responsive": true,
    });
	});



  $(document).delegate('.satuan,.harga','keyup',
    function() {
      var satuan=('.satuan').val();
      var harga=('.harga').val();
      var subtotal=(satuan*harga);
      document.find('.subtotal').val(subtotal);
      console.log(subtotal);

      

  $('#reservationdate').datetimepicker({
        format: 'L'
  });
  })
</script>
@endsection