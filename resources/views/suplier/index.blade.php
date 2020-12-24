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
						<h1 class="panel-title">Data Supplier</h1>
							<div class="right">				
								<button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i class="lnr lnr-plus-circle btn btn-primary"> Tambah Data Supplier</i>
								</button>
							</div>
							</div>								
							<div class="panel-body">
						<table id="mytable" class="table table-hover">
							<thead>
								<tr>
									
									<th>No NPWP</th>
									<th>Kode Supplier</th>
									<th>Nama Supplier</th>
									<th>Kontak</th>
									<th>Alamat</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
							<?php $no=1; ?>
							@if(count($data_sup) == 0)
	        				<tr>
	            				<td colspan="6"><center><h1> No Data</h1></center></td>
			        		</tr>
			        		@else
							@foreach($data_sup as $sup)
							<tr>
								
								<td>{{$sup->npwp}}</td>
								<td>{{$sup->kode_sup}}</td>
								<td>{{$sup->nama_sup}}</td>
								<td>{{$sup->kontak}}</td>
								<td>{{$sup->alamat}}</td>
								<td>
									<a href="/suplier/{{$sup->id}}/edit" class="lnr lnr-pencil btn btn-warning btn-sm"></a>
									<!-- <a href="/suplier/{{$sup->id}}/delete" class="lnr lnr-trash btn btn-danger btn-sm" onclick="return confirm('menghapus ini juga akan menghapus data barang ?')"></a> -->
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
<div class="modal fade" id="exampleModal"
 tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Supplier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	        <form action="\suplier\create" method="POST">
	        	{{csrf_field()}}

	        <div class="row">
	        	<div class="col-md-6">
	        		<div class="form-group">
					    <label>No NPWP</label>
					    <input name="npwp" type="text" class="form-control" placeholder="No NPWP">
			  		</div>
				  	<div class="form-group">
					    <label>Nama Supplier <span style="color: red">*</span></label>
					    <input name="nama_sup" type="text" class="form-control" placeholder="Masukkan Nama" required="">
					  </div>
	        	</div>

	        	<div class="col-md-6">
	        		 <div class="form-group">
					    <label>Kode Supplier <span style="color: red">*</span></label>
					    <input name="kode_sup" type="text" class="form-control" placeholder="Masukkan Kode" required="">
					  </div>
					  <div class="form-group">
					    <label>Kontak <span style="color: red">*</span></label>
					    <input name="kontak" type="text" class="form-control" placeholder="Masukkan Kontak" required="">
					  </div>
	        	</div>
	        </div>
	        <div class="form-group">
			    <label>Alamat</label>
			    <textarea name="alamat" class="form-control" rows="2" placeholder="Alamat"></textarea>
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
@endsection