@extends('layout.master')

@section('content')

<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading">
							<h1 class="panel-title">Ubah Data Customer</h1>
						</div>
		<div class="panel-body">
				@if(session('sukses'))
				<div class="alert alert-success" role="alert">
			  {{session('sukses')}}
				</div>
			@endif	
			<form action="\customer\{{$cust->id}}\update" method="POST">
	        	{{csrf_field()}}
	          <div class="form-group">
			    <label>No NPWP</label>
			    <input name="npwp" type="text" class="form-control" placeholder="No NPWP" value="{{$cust->npwp}}">
			  </div>	
			  <div class="form-group">
			    <label>Nama Customer</label>
			    <input name="nama_cust" type="text" class="form-control" placeholder="Nama" value="{{$cust->nama_cust}}">
			  </div>
			  <div class="form-group">
			    <label>Kontak</label>
			    <input name="kontak" type="text" class="form-control" placeholder="kontak" value="{{$cust->kontak}}">
			  </div>
			  <div class="form-group">
			    <label>Alamat</label>
			    <textarea name="alamat" type="text" class="form-control" placeholder="Alamat">{{$cust->alamat}}</textarea>
			  </div>
			  
			   <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button> -->
		       	<button type="submit" class="lnr lnr-pencil btn btn-warning btn-toastr" data-context="warning" data-message="This is warning info" data-position="top-right"> Ubah</button>
		       	<button type="button" class="lnr lnr-arrow-left-circle btn btn-secondary"><a href="/customer"> Kembali</a></button>
       		</form>
		</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop