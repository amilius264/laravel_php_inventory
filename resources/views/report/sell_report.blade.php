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
                </div>
                <!-- end panel heading -->

                  <div class="panel-body">
                      <table id="mytable" class="table table-hover table-bordered">
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
                        
                        @if(count($data_jual) == 0)
                            <tr>
                                <td colspan="8"><center><h1> No Data</h1></center></td>
                            </tr>
                            @else
                          @foreach($data_jual as $jual)
                          <?php 
                              $auto = str_pad(($jual->id),4,0,STR_PAD_LEFT);
                              $tgl_jual = date("d/m/Y", strtotime($jual->tanggal_jual));
                              $tgl_tempo = date("d/m/Y", strtotime($jual->tanggal_tempo));
                          ?>
                              @if($jual->status_id == '1')
                              
                              @else
                            <tr>
                              <td><span class="label label-success"><strong>{{$jual->status->nama_status}}</strong></span></td>
                              <td>{{$jual->faktur_no}}-{{$auto}}</td>
                              <td>{{$jual->customer->nama_cust}}</td>
                              <td>{{$tgl_jual}}</td>
                              <td><strong>{{$tgl_tempo}}</strong></td>
                              <td>{{$jual->note}}</td>
                              <td>
                                <a href="/sell_detail/{{$jual->id}}" class="lnr lnr-bookmark btn btn-info btn-sm"></a>
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