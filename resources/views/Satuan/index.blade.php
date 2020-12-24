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
						<h1 class="panel-title">Data Satuan</h1>
							<div class="right">				
								<button type="button" class="btn" data-toggle="modal" data-target="#Modaltambah"><i class="lnr lnr-plus-circle btn btn-primary"> Tambah Data Satuan</i>
								</button>
							</div>
							</div>								
							<div class="panel-body">
						<table id="mytable" class="table table-hover">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Satuan</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							<?php $no=1; ?>
							@if(count($data_satuan) == 0)
			        		<tr>
			            		<td colspan="6"><center><h1> No Data</h1></center></td>
			        		</tr>
			        		@else
							@foreach($data_satuan as $satuan)
							<tr>
								<td>
									<?php echo $no; $no++; ?>
								</td>
								<td>{{$satuan->nama_sat}}</td>
								<td>
									<a href="/satuan/{{$satuan->id}}/edit" class="lnr lnr-pencil btn btn-warning btn-sm"> Ubah</a>
									<!-- <a href="#" class="lnr lnr-trash btn btn-danger btn-sm hapus" 
									satuan-id="{{$satuan->id}}"> Hapus</a> -->
									
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
	


<!-- Modal tambah-->
<div class="modal fade" id="Modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Satuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	        <form action="\satuan\create" method="POST">
	        	{{csrf_field()}}
			  <div class="form-group">
			    <label>Nama satuan</label>
			    <input name="nama_sat" type="text" class="form-control" placeholder="Masukkan satuan" autofocus required="">
			  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
       	<button type="submit" class="btn btn-primary">Tambah</button>
       	</form>
      </div>
 	</div>
  </div>
</div>   



<!-- Modal edit-->
<div class="modal fade" id="Modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Jenis Satuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	        <form action="\satuan\update" method="POST">
	        	{{csrf_field()}}
			  <div class="form-group">
			    <label>Nama satuan</label>
			    <input name="nama_sat" type="text" class="form-control" placeholder="Masukkan satuan" required="">
			  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
       	<!-- <button type="submit" class="btn btn-primary">Tambah</button> -->
       	<button type="submit" class="btn btn-primary swalDefaultSuccess">
	      Tambah
	    </button>
       	</form>
      </div>
    </div>
   </div>
  </div>
 </div>
      	

</div>

@endsection


@section('footer')

<script type="text/javascript">
	// swal hapus
	$('.hapus').click(function(){
		var satuan_id = $(this).attr('satuan-id');
		const swalWithBootstrapButtons = Swal.mixin({
		  customClass: {
		    confirmButton: 'btn btn-primary'
		  },
		  buttonsStyling: false
		})

		swalWithBootstrapButtons.fire({
		  title: 'Yakin Ingin Menghapus?',
		  text: "Hal Ini Tidak Bisa Dibatalkan Kembali",
		  icon: 'warning',
		  showCancelButton: false,
		  confirmButtonText: 'Ya, Hapus',
		  reverseButtons: false
		})
		.then((result) => {
		  if (result.dismiss === Swal.DismissReason.backdrop) {
		    swalWithBootstrapButtons.fire(
		      'Cancel',
		      'Data Tidak Dihapus',
		      'error'
		    )
		  } else if (result) {
		  	window.location = "/satuan/"+satuan_id+"/delete"
		  	// swalWithBootstrapButtons.fire(
		   //    'Deleted!',
		   //    'Your file has been deleted.',
		   //    'success'
		   //  )
		  }
		})
	});
</script>


@endsection