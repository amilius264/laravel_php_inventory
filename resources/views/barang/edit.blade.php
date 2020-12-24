@extends('layout.master')

@section('content')

<div class="main">
		<div class="main-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="panel">
								<div class="panel-heading">
									<h1 class="panel-title">Ubah Data Barang</h1>
								</div>
		<div class="panel-body">
				@if(session('sukses'))
				<div class="alert alert-success" role="alert">
			  {{session('sukses')}}
				</div>
			@endif	
		<form action="\barang\{{$barang->id}}\update" method="POST">
	        	{{csrf_field()}}

	<div class="row">
	    	<!-- Left -->
		<div class="col-md-5">
		
			<div class="form-group">
			    <label>Kode Barang</label>
			    <input name="kode_brg" type="text" class="form-control" placeholder="Masukkan Barang" value="{{$barang->kode_brg}}">
			    @if($errors->has('kode_brg'))
			    	<span class="help-block">{{$errors->first('kode_brg')}}</span>
			    @endif
			</div>	
			<div class="form-group">
			    <label>Nama Barang</label>
			    <input name="nama_brg" type="text" class="form-control" placeholder="Masukkan Barang" value="{{$barang->nama_brg}}">
			    @if($errors->has('nama_brg'))
			    	<span class="help-block">{{$errors->first('nama_brg')}}</span>
			    @endif
			</div>
			<div class="form-group">
			    <label>Stok yang Tersedia</label>
			    <input disabled="" name="stok" type="text" class="form-control" value="{{$barang->stok}}">
			    
			</div>	

		</div>
		<!-- Rigth -->
		<div class="col-md-6">

			<div class="form-group">
			    <label>Supplier</label>
			 	<select name="suplier_id" class="form-control">
			 		<option value="{{$barang->suplier_id}}">-- {{$barang->suplier->nama_sup}} --</option>
			    	@foreach($data_sup as $sup)
			    	<option value="{{$sup->id}}"{{old('sup_id') == $sup->id ? 'selected' : ''}}>{{$sup->nama_sup}}</option>
			    	@endforeach
			    </select>
			</div>	
			<div class="form-group">
			    <label>Harga Beli</label>
			    <input name="harga_brg" type="number" class="form-control" placeholder="Masukkan harga" value="{{$barang->harga}}">
			</div>
			<div class="form-group">
			    <label>Satuan</label>
			 	<select name="satuan_id" class="form-control">
			 		<option value="{{$barang->satuan_id}}">-- {{$barang->satuan->nama_sat}} --</option>
			    	@foreach($data_sat as $sat)
			    	<option value="{{$sat->id}}"{{old('sat_id') == $sat->id ? 'selected' : ''}}>{{$sat->nama_sat}}</option>
			    	@endforeach
			    </select>
			  </div>

		</div>

		<div class="col-md-11">
		<div class="form-group">
				<div class="form-group">
				    <label>Minimal Stok</label>
				    <input name="min_stok" type="number" class="form-control" value="{{$barang->min_stok}}">
				</div>
			    <label>Catatan</label>
			    <textarea name="note" type="text" class="form-control" placeholder="Catatan" value="">{{$barang->note}}</textarea>
			</div>
				<button type="submit" class="lnr lnr-pencil btn btn-warning btn-toastr" data-context="warning" data-message="This is warning info" data-position="top-right" > Ubah</button>
			    <button type="button" class="lnr lnr-arrow-left-circle btn btn-secondary"><a href="/barang"> Kembali</a></button>	
		</div>  
	</div>
		
			
			   
		       	
       	</form>
		</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>
	
@endsection