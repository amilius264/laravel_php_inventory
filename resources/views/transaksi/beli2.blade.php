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

                      <!-- <div class="form-group">
                        <label>Nama Barang</label>
                          <select name="barang_id" id="barang_id" class="form-control" required="">
                            <option value="">--pilih--</option>
                        @foreach($data_barang as $brg)
                            <option value="{{$brg->id}}"{{(old('barang_id') == $brg->id) ? 'selected' : ''}}>{{$brg->nama_brg}}</option>
                        @endforeach
                          </select>
                      </div> -->
                      <form action="\beli\create" method="POST">
                            {{csrf_field()}}
                        <div class="form-group">
                          <label>Nama Barang</label>
                          <div class="input-group">
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="satuan_id" id="satuan_id">
                            <input name="nama_brg" id="nama_brg" type="text" value="" class="form-control" placeholder="Cari Nama Barang" required="" disabled="">
                            <span class="input-group-btn"><button type="button" data-toggle="modal" data-target="#modal-item" class="glyphicon glyphicon-search btn btn-primary"></button></span>
                          </div>

                        </div>

                        <div class="row">
                          <div class="col-sm-3">
                            <!-- <div class="form-group">
                              <label>Stok</label>
                              <input name="stok" id="stok" type="text" class="form-control" disabled="" value="">
                            </div> -->
                            <div class="form-group">
                              <label>Qty</label>
                              <input name="Temp_jumlah" id="jumlah" type="number" class="form-control" min="0" placeholder="0" required>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>Satuan</label>
                              <input name="satuan" id="satuan" type="text" class="form-control" disabled="" value="" placeholder="satuan" required="">
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>Harga Beli</label>
                              <div class="input-group">
                                <span class="input-group-addon">Rp</span>
                                <input name="Temp_price" id="harga" type="number" class="form-control" value="" placeholder="0" required>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-4">
                            <br>
                            <div class="form-group">
                              <button type="submit" class="btn btn-info fa fa-shopping-cart"> Add</button>
                            </div>
                          </div>
                          <div class="col-sm-8">
                            <br>
                            <div class="form-group">
                              @if($errors->has('nama_brg'))
                                <span class="help-block">*{{$errors->first('nama_brg')}}*</span>
                              @endif
                            </div>
                          </div>
                          
                        </div>
                      </form>  
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
            
            <div class="col-md-5">
                    <div class="panel panel-heading">
                      <div class="row">
                        <div class="col-md-3">

                                <div class="form-group">
                                    <label>Subtotal</label>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Diskon</label>
                                </div>
                                <div class="form-group">
                                    <label>PPN</label>
                                </div>
                                
                                <div class="form-group">
                                    <label>Grand Total</label>
                                </div>

                        </div>
                        <div class="col-md-8">

                                <div class="form-group">
                                  <input name="subtotal" type="text" class="form-control" disabled="" required="" value="">
                                </div>
                                <div class="form-group">
                                  <input name="Temp_diskon" type="text" class="form-control" required="" value="">
                                </div>
                                <div class="form-group">
                                  <input name="Temp_ppn" type="text" class="form-control" required="" value="">
                                </div>
                                <div class="form-group">
                                  <input name="Temp_total" type="text" class="form-control" disabled="" required="" value="">
                                </div>

                        </div>

                      </div>
                      <!-- end row in -->
                    </div>
            </div>
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

</script>
@endsection