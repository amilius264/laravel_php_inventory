@extends('layout.master')

@section('content')

	<div class="main">
		<div class="main-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="panel">
					<div class="panel-heading">
						<h1 class="panel-title">Data Siswa</h1>
							<div class="right">				
								<button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i class="lnr lnr-plus-circle"></i>
								Tambah Data Siswa
								</button>
							</div>
							</div>								
							<div class="panel-body">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Lengkap</th>
									<th>Jenis Kelamin</th>
									<th>Agama</th>
									<th>No Telp Wali</th>
									<th>Alamat</th>
									<th>Aksi</th>
								</tr>
							</thead>
							@foreach($data_siswa as $siswa)
							<tr>
								<td>
									
								</td>
								<td>{{$siswa->nama_lengkap}}</td>
								<td>{{$siswa->jenis_kelamin}} </td>
								<td>{{$siswa->agama}}</td>
								<td>{{$siswa->no_telp_wali}}</td>
								<td>{{$siswa->alamat}}</td>
								<td>
									<a href="/siswa/{{$siswa->id}}/edit" class="btn btn-warning btn-sm">Ubah</a>
									<a href="/siswa/{{$siswa->id}}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau dihapus ?')">Hapus</a>
								</td>
							</tr>
							@endforeach
						</table>						
					</div>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	        <form action="\siswa\create" method="POST">
	        	{{csrf_field()}}
			  <div class="form-group">
			    <label>Nama Lengkap</label>
			    <input name="nama_lengkap" type="text" class="form-control" placeholder="Masukkan Nama" required="">
			 
			  </div>
			  <div class="form-group">
			    <label>Jenis Kelamin</label>
			    <select name="jenis_kelamin" class="form-control">
			      <option value="laki-laki">Laki - Laki</option>
			      <option value="perempuan">Perempuan</option>
			    </select>
			  </div>
			  
			  <div class="form-group">
			    <label>Agama</label>
			    <input name="agama" type="text" class="form-control" placeholder="Agama" required="">
			  </div>
			  <div class="form-group">
			    <label>No Telp Wali</label>
			    <input name="no_telp_wali" type="text" class="form-control" placeholder="No Telp Wali Siswa" required="">
			  </div>
			  <div class="form-group">
			    <label>Alamat</label>
			    <textarea name="alamat" class="form-control" rows="2" placeholder="Alamat" required=""></textarea>
			  </div>
			  
			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
       	<button type="submit" class="btn btn-primary">Tambah</button>
       	</form>
      </div>
    </div>
  </div>
@endsection
