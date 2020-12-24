
@extends('layout.master')

@section('content')

<div class="main">
		<div class="main-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="panel">
								<div class="panel-heading">
									<h1 class="panel-title">Ubah Data Satuan</h1>
								</div>
		<div class="panel-body">
				@if(session('sukses'))
				<div class="alert alert-success" role="alert">
			  {{session('sukses')}}
				</div>
			@endif	
		<form action="\satuan\{{$satuan->id}}\update" method="POST">
	        	{{csrf_field()}}
			  <div class="form-group">
			    <label>Nama Satuan</label>
			    <input name="nama_sat" type="text" class="form-control" placeholder="Masukkan satuan" value="{{$satuan->nama_sat}}">
			  </div>
			  
			   <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button> -->
		       	<button type="submit" class="lnr lnr-pencil btn btn-warning btn-toastr" data-context="warning" data-message="This is warning info" data-position="top-right" > Ubah</button>
		       	<button type="button" class="lnr lnr-arrow-left-circle btn btn-secondary"><a href="/satuan"> Kembali</a></button>
       	</form>
		</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>
@stop