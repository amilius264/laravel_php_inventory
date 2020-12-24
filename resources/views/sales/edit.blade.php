@extends('layout.master')

@section('content')

<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading">
							<h1 class="panel-title">Ubah Data Sales</h1>
						</div>
		<div class="panel-body">
				@if(session('sukses'))
				<div class="alert alert-success" role="alert">
			  {{session('sukses')}}
				</div>
			@endif	
			<form action="\sales\{{$sales->id}}\update" method="POST">
	        	{{csrf_field()}}
			  <div class="form-group">
			    <label>Nama Sales</label>
			    <input name="nama_sales" type="text" class="form-control" placeholder="Nama" value="{{$sales->nama_sales}}">
			  </div>
			  <div class="form-group">
			    <label>Kontak</label>
			    <input name="kontak" type="text" class="form-control" placeholder="kontak" value="{{$sales->kontak}}">
			  </div>
			  <div class="form-group">
			    <label>Keaktifan</label>
			 	<select name="aktif" class="form-control" required="">
			 		<option value="{{$sales->aktif}}">-- {{$sales->aktif}} --</option>
			 		@if(($sales->aktif) == 'Aktif')
			 		<option value="Non Aktif">Non Aktif</option>
			 		@else
			 		<option value="Aktif">Aktif</option>
			 		@endif
			    </select>
			  </div>
			  <div class="form-group">
			    <label>Alamat</label>
			    <textarea name="alamat" type="text" class="form-control" placeholder="Alamat">{{$sales->alamat}}</textarea>
			  </div>

			   <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button> -->
		       	<button type="submit" class="lnr lnr-pencil btn btn-warning btn-toastr" data-context="warning" data-message="This is warning info" data-position="top-right"> Ubah</button>
		       	<button type="button" class="lnr lnr-arrow-left-circle btn btn-secondary"><a href="/sales"> Kembali</a></button>
       		</form>
		</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop