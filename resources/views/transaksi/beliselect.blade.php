@extends('layout.master')


@section('header')
<link rel="stylesheet" type="text/css" href="{{('/admin/assets/vendor/datatables/DataTables-1.10.21/css/dataTables.bootstrap4.min.css')}}">

@endsection

@section('content')


<div class="main">
  <div class="main-content">
  	<div class="container-fluid">
        <div class="row">
            <!-- left -->
            <div class="col-md-5">
                <div class="panel panel-heading">
                  <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                          <div class="input-group">
                            <input name="subtotal" type="text" class="form-control" disabled="" required="" value="">
                            <span class="input-group-addon"><strong class="label label-info">| Subtotal</strong></span>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                            <input name="Temp_diskon" type="text" class="form-control" required="" value="">
                            <span class="input-group-addon"><strong class="label label-info">| Diskon</strong></span>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                            <input name="Temp_ppn" type="text" class="form-control" required="" value="">
                            <span class="input-group-addon"><strong class="label label-info">| PPN</strong></span>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                            <input name="Temp_total" type="text" class="form-control" disabled="" required="" value="">
                            <span class="input-group-addon"><strong class="label label-info">| Grand Total</strong></span>
                          </div>
                        </div>
                    </div>

                  </div>
                </div>   
            </div>
            <!--end left  -->
            <!-- right -->
            <div class="col-md-7">
              <div class="panel panel-heading">
                <h1 class="panel-title">Detail Pembelian</h1>
                <br>
                <div class="row">
                  <div class="col-md-6">

                          <div class="form-group{{$errors->has('tanggal') ? 'has-error' : ''}}" >
                              <label>Tanggal</label>
                              <input data-date-format='yyyy-mm-dd' name="tanggal" type="date" class="form-control glyphicon-font" required="" value="{{old('tanggal')}}">
                          </div>

                          <div class="form-group">
                              <label>Nama Supplier</label>
                                <select name="suplier_id" class="form-control" required="">
                                  <option value="">--pilih--</option>
                              @foreach($data_sup as $sup)
                                  <option value="{{$sup->id}}"{{(old('suplier_id') == $sup->id) ? 'selected' : ''}}>{{$sup->nama_sup}}</option>
                              @endforeach
                                </select>
                          </div>

                  </div>
                  <div class="col-md-6">

                          <div class="form-group{{$errors->has('kode_brg') ? 'has-error' : ''}}" >
                            <label>No Invoice</label>
                            <input name="noinv" type="text" class="form-control" placeholder="No Invoice" required="" value="{{old('noinv')}}">
                            @if($errors->has('noinv'))
                              <span class="help-block with-errors">{{$errors->first('noinv')}}</span>
                            @endif
                          </div>

                          <div class="form-group">
                              <label>Catatan</label>
                              <textarea name="note" class="form-control" rows="2" placeholder="catatan" >{{old('note')}}</textarea>
                          </div>

                  </div>

                </div>
                <!-- end row in -->
              </div>
            </div>
            <!-- end right -->
            <!-- table tambah barang -->
            <div class="col-md-12">
              <div class="panel panel-footer">
                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-responsive">
                      <thead>
                        <tr>
                          <th>Nama Barang</th>
                          <th>Qty</th>
                          <th>Satuan</th>
                          <th>Harga</th>
                          <th>Total</th>
                          <th>
                            <a href="#" class="addRow"><i class="glyphicon glyphicon-plus">Tambah</i></a>
                          </th>
                        </tr>
                      </thead>
                        <tr>
                          <input type="hidden" name="id[]" id="id">
                          <input type="hidden" name="satuan_id[]" id="satuan_id">
                          <td>
                            <select id="select_brg" name="nama_brg[]" class="form-control" required="">
                            <option value="">--pilih--</option>
                          @foreach($data_barang as $brg)
                            <option value="{{$brg->id}}" {{(old('nama_brg') == $brg->id) ? 'selected' : ''}}>{{$brg->nama_brg}}
                            </option>
                            <!-- 
                            data-id="{{$brg->id}}"
                                    data-nama="{{$brg->nama_brg}}"
                                    data-satuan_id="{{$brg->satuan_id}}"
                                    data-satuan="{{$brg->satuan->nama_sat}}"
                                    data-harga="{{$brg->harga}}" -->
                          @endforeach
                          </select>
                          </td>
                          <td class="col-sm-1">
                            <input name="jumlah[]" id="jumlah" type="number" class="form-control" min="0" placeholder="0" required>
                          </td>
                          <td class="col-md-1">
                            <input name="satuan[]" id="satuan" type="text" class="form-control" disabled="" value="" placeholder="satuan" required="">
                          </td>
                          <td class="col-md-2">
                            <input name="price[]" id="harga" type="number" class="form-control" value="" placeholder="0" required>
                          </td>
                          <td class="col-md-2">
                            <input name="total[]" id="total" type="text" class="form-control" value="" placeholder="0" required disabled="">
                          </td>
                          <td>
                            <span class="input-group-btn remove"><button type="button" class="glyphicon glyphicon-remove btn btn-danger"></button></span>
                          </td>
                        </tr>
                    </table>
                  </div>
                  <div class="col-md-8">

                  </div>
                </div>
                <!-- end row in -->
              </div>
            </div> 
            <!--end table tambah barang -->

            <div class="col-md-5">
              
                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                      <button type="submit" class="btn btn-success fa fa-paper-plane"> Proses</button>
                    </div>
                  </div>
                </div>
              
            </div>
        </div>
        <!-- end row out-->
  	</div>
  </div>
</div>
<!-- end main -->

@include('transaksi.caribrg')

@endsection

@section('footer')

<script type="text/javascript" src="{{('/admin/assets/vendor/datatables/DataTables-1.10.21/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{('/admin/assets/vendor/datatables/DataTables-1.10.21/js/dataTables.bootstrap4.min.js')}}"></script>

<script>	
	$(document).ready(function(){
		$('#mytable').DataTable();
	});

  // $(document).ready(function(){
  //   $(document).on('click', '#select', function() {
  //     var id = $(this).data('id');
  //     var nama_brg = $(this).data('nama');
  //     var satuan_id = $(this).data('satuan_id');
  //     var satuan = $(this).data('satuan');
  //     var harga = $(this).data('harga');
  //     $('#id').val(id);
  //     $('#nama_brg').val(nama_brg);
  //     $('#satuan_id').val(satuan_id);
  //     $('#satuan').val(satuan);
  //     $('#harga').val(harga);
  //     $('#modal-item').modal('hide');
  //   })
  // });

</script>


<script type="text/javascript">
  $('.addRow').on('click',function(){
    addRow();
  });
  function addRow()
  {
    var tr="<tr>"+
    '<input type="hidden" name="id[]" id="id">'+
    '<input type="hidden" name="satuan_id[]" id="satuan_id">'+
    '<td><select id="select_brg" name="nama_brg[]" class="form-control" required=""><option value="">--pilih--</option>@foreach($data_barang as $brg)<option value="{{$brg->id}}"{{(old("nama_brg") == $brg->id) ? "selected" : ""}}>{{$brg->nama_brg}}</option>@endforeach</select></td>'+
    '<td class="col-sm-1"><input name="jumlah[]" id="jumlah" type="number" class="form-control" min="0" placeholder="0" required></td>'+
    '<td class="col-md-1"><input name="satuan[]" id="satuan" type="text" class="form-control" disabled="" value="" placeholder="satuan" required=""></td>'+
    '<td class="col-md-2"><input name="price[]" id="harga" type="number" class="form-control" value="" placeholder="0" required></td>'+
    '<td class="col-md-2"><input name="total[]" id="total" type="text" class="form-control" value="" placeholder="0" required disabled=""></td>'+
    '<td><span class="input-group-btn remove"><button type="button" class="glyphicon glyphicon-remove btn btn-danger"></button></span></td>'+
    "</tr>";
    $("tbody").append(tr);
  };
  
  $('.remove').on('click',function(){
    var last=$('tbody tr').length;
    if(last==1){
      alert('ini baris terakhir');
    } else {
      $(this).parent().parent().remove();
    }
  });

</script>


@endsection