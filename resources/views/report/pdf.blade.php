<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Invoice</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <!-- VENDOR CSS -->
  <link rel="stylesheet" href="{{('/admin/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
  <!-- <link rel="stylesheet" href="../../plugins/bootstrap/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="{{('/admin/assets/vendor/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{('/admin/assets/vendor/linearicons/style.css')}}">
  <!-- MAIN CSS -->
  <link rel="stylesheet" href="{{('/admin/assets/css/main.css')}}">
  <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
  <!-- <link rel="stylesheet" href="{{('/admin/assets/css/demo.css')}}"> -->
  <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
  <!-- ICONS -->
  <link rel="apple-touch-icon" sizes="76x76" href="{('/admin/assets/img/apple-icon.png')}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{('/admin/assets/img/favicon.png')}}">

</head>
<body>

  <div class="row">
    <div class="col-md-12">
      <table class="static" rules="all" border="1px" style="width: 95%;">
        <thead>
          <tr>
            <td colspan="6">
              <div class="input-group">
                  <center><h2>Nota Penjualan</h2></center>
                  <strong>CV ABCD</strong> <br>
                  Jl. Sapta Marga Ruko Kelapa Kembar No.2 Rt.15 Rw.03 Kel. Bukit Sangkal <br>
                  Kec. Kalidoni Kota Palembang Telp : 0821 8040 0406 <br>
              </div>
            </td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td colspan="4" rowspan="2">
              <strong>Nama Customer</strong> <br>
              {{$jual->customer->nama_cust}} <br>
              {{$jual->customer->alamat}} <br>
              {{$jual->customer->kontak}} 
            </td>
            <td colspan="2" style="text-align: center;">
              <strong>{{$jual->faktur_no}}-{{$auto}}</strong>
              <tr>
                <td>
                  Tanggal Jual  <br>
                  Jatuh Tempo
                </td>
                <td>
                  {{$tgl_jual}}<br>
                  <strong>{{$tgl_tempo}}</strong><br>
                </td>
              </tr>
            </td>
          </tr>
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
          @foreach($jual->details as $detail)
            <?php
              $total_beli += $detail->total;
            ?>
            <tr>
              <td><center><?php echo $no; $no++; ?></center></td>
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

      <table class="static" rules="all" border="1px" style="width: 95%;">
        <?php
          $total_byr=0;
          $byr_ppn=0;
        ?>
        <tr>
          <td colspan="6">
            <b><i>Catatan :</b> {{$jual->note}}</i>
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
            <td colspan="6"></td>
            <td>PPN 10%</td>
            <?php
              $total_byr = $total_beli + $jual->ppn;
            ?>
            <td>
              Rp {{number_format($jual->ppn,0,'.','.')}}
            </td>
          </tr>
          <tr>
            <td colspan="6"></td>
            <td>Total Bayar</td>
            <td>Rp {{number_format($total_byr,0,'.','.')}}</td>
          </tr>
          <tr>
            <td colspan="4">Tanda Terima</td>
            <td colspan="3">Pengirim</td>
            <td>Salesman</td>
          </tr>
          
        </tbody>
      </table>


    </div>
  </div>
</body>
</html>