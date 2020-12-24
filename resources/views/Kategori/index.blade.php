@extends('layout.master')

@section('content')

	<div class="main">
		<div class="main-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
							@if(session('sukses'))
								<div class="alert alert-success" role="alert">
							  	{{session('sukses')}}
								</div>
							@endif	
						<div class="panel">
					<div class="panel-heading">
						
						<h1 class="panel-title">Data Kategori</h1>
							<div class="right">				
								<button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i class="lnr lnr-plus-circle btn btn-primary"></i>
								Tambah Data Kategori
								</button>
							</div>
							</div>								
							<div class="panel-body">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Kategori</th>
								</tr>
							</thead>
							<?php $no=1; ?>
							@if(count($data_kategori) == 0)
			        		<tr>
			            		<td colspan="6"><center><h1> No Data</h1></center></td>
			        		</tr>
			        		@else
							@foreach($data_kategori as $kategori)
							<tr>
								<td>
									<?php echo $no; $no++; ?>
								</td>
								<td>{{$kategori->nama_kat}}</td>
								<td>
									<a href="/kategori/{{$kategori->id}}/edit" class="lnr lnr-pencil btn btn-warning btn-sm"> Ubah</a>
									<a href="/kategori/{{$kategori->id}}/delete" class="lnr lnr-trash btn btn-danger btn-sm" onclick="return confirm('Yakin mau dihapus ?')"> Hapus</a>
								</td>
							</tr>
							@endforeach
							@endif
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	        <form action="\kategori\create" method="POST">
	        	{{csrf_field()}}
			  <div class="form-group">
			    <label>Nama Kategori</label>
			    <input name="nama_kat" type="text" class="form-control" placeholder="Masukkan Kategori" required="">
			 
			  </div>
			  
			  
			
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
