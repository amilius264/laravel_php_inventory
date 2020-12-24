
@extends('layout.master')

@section('content')

<div class="main">
		<div class="main-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="panel">
								<div class="panel-heading">
									<h1 class="panel-title">Ubah Data Beli</h1>
								</div>
		<div class="panel-body">
				@if(session('sukses'))
				<div class="alert alert-success" role="alert">
			  {{session('sukses')}}
				</div>
			@endif	
		<form action="\beli\{{$data_beli->id}}\update" method="POST">
	        	{{csrf_field()}}
			  <div class="form-group">
			    <label>No Invoice</label>
			    <input name="noinv" type="text" class="form-control" value="{{$data_beli->noinv}}">
			  </div>
			  <div class="form-group">
			    <label>Supplier</label>
			 	<select name="suplier_id" class="form-control">
			 		<option value="{{$data_beli->suplier_id}}">-- {{$data_beli->suplier->nama_sup}} --</option>
			    	@foreach($data_sup as $sup)
			    	<option value="{{$sup->id}}"{{old('sup_id') == $sup->id ? 'selected' : ''}}>{{$sup->nama_sup}}</option>
			    	@endforeach
			    </select>
			  </div>
			  <div class="form-group{{$errors->has('tanggal') ? 'has-error' : ''}}">
                  <label>Tanggal</label>
                  <input data-date-format='yyyy-mm-dd' name="tanggal_beli" type="date" class="form-control glyphicon-font" required="" value="{{$data_beli->tanggal_beli}}">
              </div>	
              <div class="form-group">
                  <label>Catatan</label>
                  <textarea name="note" class="form-control" rows="2" placeholder="catatan" >{{$data_beli->note}}</textarea>
              </div>
			  
			   <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button> -->
		       	<button type="submit" class="lnr lnr-pencil btn btn-warning btn-toastr" data-context="warning" data-message="This is warning info" data-position="top-right" > Ubah</button>
		       	<button type="button" class="lnr lnr-arrow-left-circle btn btn-secondary"><a href="/beli"> Kembali</a></button>
       	</form>
		</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>
@stop