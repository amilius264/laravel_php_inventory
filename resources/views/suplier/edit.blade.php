
@extends('layout.master')

@section('content')

<div class="main">
		<div class="main-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="panel">
								<div class="panel-heading">
									<h1 class="panel-title">Ubah Data Supplier</h1>
								</div>
		<div class="panel-body">
				@if(session('sukses'))
				<div class="alert alert-success" role="alert">
			  {{session('sukses')}}
				</div>
			@endif	
		<form action="\suplier\{{$suplier->id}}\update" method="POST">
	        	{{csrf_field()}}
			  <div class="form-group">
			    <label>No NPWP</label>
			    <input name="npwp" type="text" class="form-control" placeholder="Masukkan NPWP" value="{{$suplier->npwp}}">
			  </div>
			  <div class="form-group">
			    <label>Kode Supplier</label>
			    <input disabled="" name="kode_sup" type="text" class="form-control" placeholder="Masukkan Supplier" value="{{$suplier->kode_sup}}" required="">
			  </div>
			  <div class="form-group">
			    <label>Nama Supplier</label>
			    <input name="nama_sup" type="text" class="form-control" placeholder="Masukkan Nama" value="{{$suplier->nama_sup}}" required="">
			  </div>
			  <div class="form-group">
			    <label>Kontak</label>
			    <textarea name="kontak" type="text" class="form-control" placeholder="Alamat">{{$suplier->kontak}}</textarea>
			  </div>
			  <div class="form-group">
			    <label>Alamat</label>
			    <textarea name="alamat" type="text" class="form-control" placeholder="Alamat">{{$suplier->alamat}}</textarea>
			  </div>
			  
			   
		       	<button type="submit" class="lnr lnr-pencil btn btn-warning btn-toastr" data-context="warning" data-message="This is warning info" data-position="top-right" > Ubah</button>
		       	<button type="button" class="lnr lnr-arrow-left-circle btn btn-secondary"><a href="/suplier"> Kembali</a></button>
       	</form>
		</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>
@stop