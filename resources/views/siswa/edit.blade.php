@extends('layout.master')


@section('content')

<div class="main">
		<div class="main-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="panel">
								<div class="panel-heading">
									<h1 class="panel-title">Ubah Data Siswa</h1>
								</div>
		<div class="panel-body">
				@if(session('sukses'))
				<div class="alert alert-success" role="alert">
			  {{session('sukses')}}
				</div>
			@endif	
		<form action="\siswa\{{$siswa->id}}\update" method="POST">
	        	{{csrf_field()}}
			  <div class="form-group">
			    <label>Nama Lengkap</label>
			    <input name="nama_lengkap" type="text" class="form-control" placeholder="Masukkan Nama" value="{{$siswa->nama_lengkap}}">
			 
			  </div>
			  <div class="form-group">
			    <label>Jenis Kelamin</label>
			    <select name="jenis_kelamin" class="form-control">
			      <option value="laki-laki" @if($siswa->jenis_kelamin == "laki-laki") selected @endif>Laki - Laki</option>
			      <option value="perempuan" @if($siswa->jenis_kelamin == "perempuan") selected @endif>Perempuan</option>
			    </select>
			  </div>
			  
			  <div class="form-group">
			    <label>Agama</label>
			    <input name="agama" type="text" class="form-control" placeholder="Agama" value="{{$siswa->agama}}">
			  </div>
			  <div class="form-group">
			    <label>No Telp Wali</label>
			    <input name="no_telp_wali" type="text" class="form-control" placeholder="No Telp Wali Siswa" value="{{$siswa->no_telp_wali}}">
			  </div>
			  <div class="form-group">
			    <label>Alamat</label>
			    <textarea name="alamat" class="form-control" rows="2" placeholder="Alamat">{{$siswa->alamat}}</textarea>
			  </div>
			   <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button> -->
		       	<button type="submit" class="btn btn-warning btn-sm" >Ubah</button>
		       	<button type="button" class="btn btn-secondary btn-sm"><a href="/siswa">Kembali</a></button>
       	</form>
       	
							</div>
					</div>
				</div>
			</div>
		</div>
</div>
@stop


@section('content1')

	<h1>EDIT DATA SISWA</h1>
			@if(session('sukses'))
				<div class="alert alert-success" role="alert">
			  {{session('sukses')}}
				</div>
			@endif	
	<div class="row">
		<div class="col-12">
		<form action="\siswa\{{$siswa->id}}\update" method="POST">
	        	{{csrf_field()}}
			  <div class="form-group">
			    <label>Nama Lengkap</label>
			    <input name="nama_lengkap" type="text" class="form-control" placeholder="Masukkan Nama" value="{{$siswa->nama_lengkap}}">
			 
			  </div>
			  <div class="form-group">
			    <label>Jenis Kelamin</label>
			    <select name="jenis_kelamin" class="form-control">
			      <option value="laki-laki" @if($siswa->jenis_kelamin == "laki-laki") selected @endif>Laki - Laki</option>
			      <option value="perempuan" @if($siswa->jenis_kelamin == "perempuan") selected @endif>Perempuan</option>
			    </select>
			  </div>
			  
			  <div class="form-group">
			    <label>Agama</label>
			    <input name="agama" type="text" class="form-control" placeholder="Agama" value="{{$siswa->agama}}">
			  </div>
			  <div class="form-group">
			    <label>No Telp Wali</label>
			    <input name="no_telp_wali" type="text" class="form-control" placeholder="No Telp Wali Siswa" value="{{$siswa->no_telp_wali}}">
			  </div>
			  <div class="form-group">
			    <label>Alamat</label>
			    <textarea name="alamat" class="form-control" rows="2" placeholder="Alamat">{{$siswa->alamat}}</textarea>
			  </div>
			  
			
    </div>
      
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button> -->
       	<button type="submit" class="btn btn-warning btn-sm" >Ubah</button>
       	</form>
       	
	</div>

	@endsection
