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
                <div class="panel-body">
                  <table class="table table-bordered table-responsive">
                    <thead>
                      <tr>
                        <th colspan="6">
                          <div class="input-group">
                            <span class="input-group-addon"><img src="../../admin/assets/img/favicon.png"></span>
                              <h2>CV ABCD</h2>
                              <p>Jl. Sapta Marga Ruko Kelapa Kembar No.2 Rt.15 Rw.03 Kel. Bukit Sangkal <br>
                              Kec. Kalidoni Kota Palembang Telp : 0821 8040 0406</p>
                              <h2 class="right">Nota Penjualan</h2>
                          </div>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td rowspan="2" colspan="4">
                          <strong>Nama Customer :</strong> <br>
                          {{$data_jual->customer->nama_cust}}
                          <p>{{$data_jual->customer->alamat}}</p>
                          {{$data_jual->customer->kontak}}
                        </td>
                        <td colspan="2" style="text-align: center;">
                          <strong>{{$data_jual->faktur_no}}-{{$auto}}</strong>
                          <tr>
                            <td>
                            Tanggal Jual  <br>
                            Jatuh Tempo  <br>
                            Status
                            </td>
                            <td>
                              {{$tgl_jual}}<br>
                              <strong>{{$tgl_tempo}}</strong><br>
                                <span class="label label-primary"><strong>{{$data_jual->status->nama_status}}</strong></span>
                            </td>
                          </tr>
                        </td>
                      </tr>
                      <form>
                        <thead>
                      <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>QTY</th>
                            <th class="col-md-2">Harga</th>
                            <th>Diskon</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $no=1; 
                            $total_qty=0;
                            $total_beli=0;
                          ?>
                        @foreach($data_jual->details as $detail)
                        <?php
                          $total_beli += $detail->total;
                        ?>
                        <tr>
                          <td><?php echo $no; $no++; ?></td>
                          <td>{{$detail->barang->nama_brg}}</td>
                          <td>
                            {{$detail->qty}} {{$detail->satuan->nama_sat}}
                          </td>
                          <td>
                            Rp {{number_format($detail->price,0,'.','.')}}
                          </td>
                          <td>
                            Rp {{number_format($detail->disc,0,'.','.')}}
                          </td>
                          <td>
                            Rp {{number_format($detail->total,0,'.','.')}}
                          </td>
                        </tr>
                      </tbody>
                        @endforeach
                    </tbody>
                  </table>

                  <table class="table table-responsive" cellspacing="0" cellpadding="0">
                    <?php
                      $total_byr=0;
                      $byr_ppn=0;
                    ?>
                    <tr>
                      <td colspan="4">
                        <b><i>Catatan :</b> {{$data_jual->note}}</i>
                      </td>
                      <td>
                        <i>Jumlah</i>
                      </td>
                      <td>
                        <b>Rp {{number_format($total_beli,0,'.','.')}}</b>
                      </td>
                    </tr>
                    
                    <tbody>
                      <tr>
                        <td colspan=4></td>
                        <td>PPN 10%</td>
                        <?php
                          $total_byr = $total_beli + $data_jual->ppn;
                        ?>
                        <td>
                          Rp {{number_format($data_jual->ppn,0,'.','.')}}
                        </td>
                      </tr>
                      
                      <tr>
                        <td>Tanda Terima</td>
                        <td>Pengirim</td>
                        <td colspan="2"><span style="color: white;">xxx</span>Salesman</td>
                        <th>Total Bayar</th>
                        <th>
                          Rp {{number_format($total_byr,0,'.','.')}}
                        </th>
                      </tr>
                      <tr><td rowspan="6"></td></tr>
                      <tr><td rowspan="6"></td></tr>
                      <tr>
                        <td rowspan="2">
                          <p style="color: white;">xxxxx</p>
                          <p style="color: white;">xxxxx</p>
                          {{$data_jual->sales->nama_sales}}
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div>
                    <div class="panel-body"></div>
                  </div>
                        <div>
                          <a target="_blank" href="/sell/pdf/{{$data_jual->id}}" class="lnr lnr-download btn btn-info"> Export PDF</a>
                          <button type="button" class="lnr lnr-arrow-left-circle btn btn-secondary"><a href="/sell_report"> Kembali</a></button>
                        </div>
                      </form>
                </div>
                <!-- End panel body -->
              </div>
              <!-- end panel -->
           </div>
           <!-- end col -->
        </div>
        <!-- end row out-->
  	</div>
  </div>
</div>
<!-- end main -->

@endsection

@section('footer')

<script type="text/javascript" src="{{('/admin/assets/vendor/datatables/DataTables-1.10.21/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{('/admin/assets/vendor/datatables/DataTables-1.10.21/js/dataTables.bootstrap4.min.js')}}"></script>

@endsection