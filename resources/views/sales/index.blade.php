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
		      <h1 class="panel-title">Data Sales</h1>
		      <div class="right">
		      	<button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i class="lnr lnr-plus-circle btn btn-primary"> Tambah Data Sales</i></button>
		      </div>
		    </div>
		    <!-- End Panel Head -->
		      <div class="panel-body">
		        <table id="mytable" class="table table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Sales</th>
							<th>Kontak</th>
							<th>Alamat</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php $no=1; ?>
					@if(count($data_sales) == 0)
	        		<tr>
	            		<td colspan="6"><center><h1> No Data</h1></center></td>
	        		</tr>
	        		@else
					@foreach($data_sales as $sal)
					<tr>
						<td><?php echo $no; $no++; ?></td>
						<td>{{$sal->nama_sales}}</td>
						<td>{{$sal->kontak}}</td>
						<td>{{$sal->alamat}}</td>
						@if(($sal->aktif) == 'Non Aktif')
						<td><span class="label label-default"><strong>{{$sal->aktif}}</strong></span></td>
						@else
						<td><span class="label label-info"><strong>{{$sal->aktif}}</strong></span></td>
						@endif
						<td>
							<a href="/sales/{{$sal->id}}/edit" class="lnr lnr-pencil btn btn-warning btn-sm"></a>
							<!-- <a href="/sales/{{$sal->id}}/delete" class="lnr lnr-trash btn btn-danger btn-sm" onclick="return confirm('Yakin mau menghapus {{$sal->nama_sales}} ?')"></a> -->
							<a href="#" class="lnr lnr-trash btn btn-danger btn-sm hapus" 
									sales-id="{{$sal->id}}"></a>
						</td>
					</tr>
					@endforeach
					@endif
					</tbody>
				</table>	  	
		      </div>
		      <!-- End panel body -->
		  </div>
		  <!-- End panel -->
	    </div>	
	  </div>
    </div>
  </div>
</div>
<!-- end main -->

<!-- modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Sales</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

	    <div class="modal-body">
	   		<form action="\sales\create" method="POST">
	        	{{csrf_field()}}
			  <div class="form-group">
			    <label>Nama Sales <span style="color: red">*</span></label>
			    <input name="nama_sales" type="text" class="form-control" placeholder="Nama" required>
			    <span class="help-block with-errors"></span>
			  </div>
			  <div class="form-group">
			    <label>Kontak <span style="color: red">*</span></label>
			    <input name="kontak" type="text" class="form-control" placeholder="Kontak" required="">
			  </div>
			  <div class="form-group">
			    <label>Alamat</label>
			    <textarea name="alamat" class="form-control" rows="2" placeholder="Alamat"></textarea>
			  </div>
			  <h6 style="color: red">(*) Harus Diisi</h6>
		</div>
			
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
       		<button type="submit" class="btn btn-primary">Tambah</button>
       		</form>
		</div>
	</div>
  </div>
</div>
<!-- end modal -->

@endsection

@section('footer')

<script type="text/javascript" src="{{('/admin/assets/vendor/datatables/DataTables-1.10.21/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{('/admin/assets/vendor/datatables/DataTables-1.10.21/js/dataTables.bootstrap4.min.js')}}"></script>

<script>	
	$(document).ready(function(){
		$('#mytable').DataTable();
	});

	$('.hapus').click(function(){
		var sales_id = $(this).attr('sales-id');
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
		  	window.location = "/sales/"+sales_id+"/delete"
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