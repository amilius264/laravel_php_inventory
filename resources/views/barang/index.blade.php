@extends('layout.master')


@section('header')
<!-- <link rel="stylesheet" type="text/css" href="{{('/admin/assets/vendor/datatables/DataTables-1.10.21/css/dataTables.bootstrap4.min.css')}}"> -->
<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')

	<div class="main">
		<div class="main-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="panel">
					<div class="panel-heading">
						<h1 class="panel-title">Data Barang</h1>
							<div class="right">				
								<button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i class="lnr lnr-plus-circle btn btn-primary"> Tambah Data Barang</i>
								</button>
							</div>
							</div>								
							<div class="panel-body">
						<table id="mytable" class="table table-hover table-responsive">
							<thead>
								<tr>
									
									<th>Kode Barang</th>
									<th>Nama Barang</th>
									<th>Stok</th>
									<th>Minimal Stok</th>
									<th>Satuan</th>
									<th>Harga Beli</th>
									<th>Supplier</th>
									<th>Catatan</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
							<?php $no=1; ?>
							@if(count($data_barang) == 0)
                				<tr>
                    				<td colspan="10"><center><h1>No Data</h1></center></td>
                				</tr>
                			@else
							@foreach($data_barang as $barang)
							<tr>
								
								<td>{{$barang->kode_brg}}</td>
								<td>{{$barang->nama_brg}}</td>
								<td>{{$barang->stok}}</td>
								<td>{{$barang->min_stok}}</td>
								<td>{{$barang->satuan->nama_sat}}</td>
								<td>Rp {{number_format($barang->harga,0,'.','.')}}</td>
								<td>{{$barang->suplier->nama_sup}}</td>
								<td>{{$barang->note}}</td>
								<td>
									<a href="/barang/{{$barang->id}}/edit" class="lnr lnr-pencil btn btn-warning btn-sm"></a>
									<!-- <a href="/barang/{{$barang->id}}/delete" class="lnr lnr-trash btn btn-danger btn-sm btndelete" onclick="return confirm('Yakin mau menghapus {{$barang->nama_brg}} dari supplier {{$barang->suplier->nama_sup}}?')"></a> -->
									<a href="#" class="lnr lnr-trash btn btn-danger btn-sm hapus"
									brg-id="{{$barang->id}}"></a>
									
								</td>
							</tr>
							@endforeach
							@endif
							</tbody>
						</table>						
						</div>
						</div>
					</div>
					</div>

				</div>
			</div>
		</div>

	
	
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
	        <form action="\barang\create" method="POST">
	        	{{csrf_field()}}
			  
    <div class="row">
    	<!-- Left -->
    	<div class="col-md-6">
    		<div class="form-group{{$errors->has('kode_brg') ? 'has-error' : ''}}" >
			    <label>Kode Barang <span style="color: red">*</span></label>
			    <input name="kode_brg" type="text" class="form-control" placeholder="Masukkan Kode" required="" value="{{old('kode_brg')}}">
			    @if($errors->has('kode_brg'))
			    	<span class="help-block with-errors" style="color: red">{{$errors->first('kode_brg')}}</span>
			    @endif
			  </div>
    	</div>	
    	<!-- Right -->
    	<div class="col-md-6">
    		<div class="form-group">
			    <label>Supplier <span style="color: red">*</span></label>
			 	<select name="suplier_id" class="form-control" required="">
			 		<option value="">--pilih--</option>
			 	@foreach($data_sup as $sup)
			    	<option value="{{$sup->id}}"{{(old('suplier_id') == $sup->id) ? 'selected' : ''}}>{{$sup->nama_sup}}</option>
			    @endforeach
			    </select>
			</div>
    	</div>
    </div>

			<div class="form-group{{$errors->has('kode_brg') ? 'has-error' : ''}}">
			    <label>Nama Barang <span style="color: red">*</span></label>
			    <input name="nama_brg" type="text" class="form-control" placeholder="Masukkan Nama Barang" required="" value="{{old('nama_brg')}}">
			    @if($errors->has('nama_brg'))
			    	<span class="help-block" style="color: red">{{$errors->first('nama_brg')}}</span>
			    @endif
			</div>
			<div class="form-group">
			    <label>Minimal Stok <span style="color: red">*</span></label>
			    <input name="min_stok" type="number" class="form-control" placeholder="Minimal Stok" required="" value="{{old('min_stok')}}">			    
			  </div>


	<div class="row">
		<!-- left -->
		<div class="col-md-6">
			<div class="form-group">
			    <label>Harga Beli <span style="color: red">*</span></label>
			    <input name="harga" type="number" class="form-control" placeholder="Masukkan Harga" required="" value="{{old('harga')}}">			    
			  </div>
		</div>
		<!-- right -->
		<div class="col-md-6">
			<div class="form-group">
			    <label>Satuan <span style="color: red">*</span></label>
			 	<select name="satuan_id" class="form-control" required="">
			 		<option value="">--pilih--</option>
			 	@foreach($data_sat as $sat)
			    	<option value="{{$sat->id}}"{{old('sat_id') == $sat->id ? 'selected' : ''}}>{{$sat->nama_sat}}</option>
			    @endforeach
			    </select>
			  </div>
		</div>
	</div>		  
			<div class="form-group">
			    <label>Catatan</label>
			    <textarea name="note" class="form-control" rows="1" placeholder="catatan" >{{old('note')}}</textarea>
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
	

</div>
@endsection

@section('footer')

<script type="text/javascript" src="{{('/admin/assets/vendor/datatables/DataTables-1.10.21/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{('/admin/assets/vendor/datatables/DataTables-1.10.21/js/dataTables.bootstrap4.min.js')}}"></script>

<script>	
	$(document).ready(function(){
		$('#mytable').DataTable();
	});
</script>

<script type="text/javascript">
	$('.hapus').click(function(){
		var brg_id = $(this).attr('brg-id');
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
		  	window.location = "/barang/"+brg_id+"/delete"
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