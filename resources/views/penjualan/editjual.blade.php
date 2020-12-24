
@extends('layout.master')

@section('content')

<div class="main">
		<div class="main-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="panel">
								<div class="panel-heading">
									<h1 class="panel-title">Ubah Data Jual</h1>
								</div>
								<?php 
		                          $auto = str_pad($data_jual['id'],4,0,STR_PAD_LEFT);
		                        ?>
		<div class="panel-body">
				@if(session('sukses'))
				<div class="alert alert-success" role="alert">
			  {{session('sukses')}}
				</div>
			@endif	
		<form action="\jual\{{$data_jual->id}}\update" method="POST">
	        	{{csrf_field()}}
			  <div class="form-group">
			    <label>No Faktur</label>
			    <input name="faktur_no" type="text" class="form-control" value="{{$data_jual->faktur_no}}-{{$auto}}" disabled="">
			  </div>
			  <div class="form-group">
			    <label>Customer</label>
			 	<select name="customer_id" class="form-control">
			 		<option value="{{$data_jual->customer_id}}">-- {{$data_jual->customer->nama_cust}} --</option>
			    	@foreach($data_cust as $cust)
			    	<option value="{{$cust->id}}"{{old('cust_id') == $cust->id ? 'selected' : ''}}>{{$cust->nama_cust}}</option>
			    	@endforeach
			    </select>
			  </div>

			  <div class="row">
                <!-- Left -->
                <div class="col-md-6">
                  <div class="form-group{{$errors->has('tanggal_jual') ? 'has-error' : ''}}">
                      <label>Tanggal Jual</label>
                        <input data-date-format='yyyy-mm-dd' name="tanggal_jual" type="date" class="form-control datepicker" value="{{$data_jual->tanggal_jual}}" autocomplete="off">
                  </div>
                </div>
                <!-- Right -->
                <div class="col-md-6">
                  <div class="form-group{{$errors->has('tanggal_tempo') ? 'has-error' : ''}}">
                      <label>Jatuh Tempo</label>
                        <input data-date-format='yyyy-mm-dd' name="tanggal_tempo" type="date" class="form-control datepicker" value="{{$data_jual->tanggal_tempo}}" autocomplete="off">
                  </div>
                </div>
              </div>

              <div class="form-group">
			    <label>Sales</label>
			 	<select name="sales_id" class="form-control">
			 		<option value="{{$data_jual->sales_id}}">-- {{$data_jual->sales->nama_sales}} --</option>
			    	@foreach($data_sales as $sal)
			    	<option value="{{$sal->id}}"{{old('sal_id') == $sal->id ? 'selected' : ''}}>{{$sal->nama_sales}}</option>
			    	@endforeach
			    </select>
			  </div>
              <div class="form-group">
                  <label>Catatan</label>
                  <textarea name="note" class="form-control" rows="2" placeholder="catatan" >{{$data_jual->note}}</textarea>
              </div>
			  
			   <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button> -->
		       	<button type="submit" class="lnr lnr-pencil btn btn-warning btn-toastr" data-context="warning" data-message="This is warning info" data-position="top-right" > Ubah</button>
		       	<button type="button" class="lnr lnr-arrow-left-circle btn btn-secondary"><a href="/jual"> Kembali</a></button>
       	</form>
		</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>
@stop