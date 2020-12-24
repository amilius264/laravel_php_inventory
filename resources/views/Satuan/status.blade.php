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
						<h1 class="panel-title">Data Status</h1>
							<div class="right">				
								<button type="button" class="btn" data-toggle="modal" data-target="#Modaltambah"><i class="lnr lnr-plus-circle btn btn-primary"> Tambah Data Status</i>
								</button>
							</div>
							</div>								
							<div class="panel-body">
						<table id="mytable" class="table table-hover">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Status</th>
								</tr>
							</thead>
							<tbody>
							<?php $no=1; ?>
							@if(count($stat) == 0)
			        		<tr>
			            		<td colspan="6"><center><h1> No Data</h1></center></td>
			        		</tr>
			        		@else
							@foreach($stat as $s)
							<tr>
								<td>
									<?php echo $no; $no++; ?>
								</td>
								<td>{{$s->nama_status}}</td>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	        <form action="\status\create" method="POST">
	        	{{csrf_field()}}
			  <div class="form-group">
			    <label>Nama status</label>
			    <input name="nama_status" type="text" class="form-control" placeholder="Masukkan status" autofocus required="">
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


@section('footer')

<script type="text/javascript">
	
</script>


@endsection