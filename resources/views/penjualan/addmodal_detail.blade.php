<!-- modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="modal-itemLabel">Tambah Detail Barang</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <div class="modal-body">
          <form action="/detailjual/add" method="POST">
            {{csrf_field()}}
          <div class="form-group">
            <label>Nama Barang</label>
            <div class="input-group">
              <input type="hidden" name="jual_id" class="form-control" value="{{$data_jual->id}}">
              <input type="hidden" name="id" id="id">
              <input type="hidden" name="satuan_id" id="satuan_id">
              <input name="nama_brg" id="nama_brg" type="text" value="" class="form-control" placeholder="Cari Nama Barang" required disabled="">
              <span class="input-group-btn"><button type="button" data-toggle="modal" data-target="#modal-item" class="glyphicon glyphicon-search btn btn-primary"></button></span>
            </div>
              <div class="form-group">
                @if($errors->has('nama_brg'))
                  <span class="help-block" style="color: red;">*{{$errors->first('nama_brg')}}*</span>
                @endif
              </div>

          </div>

          <div class="row">
            <div class="col-sm-2">
              <div class="form-group">
                <label>Qty</label>
                <input name="qty" id="qty" type="number" class="form-control" min="0" placeholder="0" required>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                <label>Satuan</label>
                <input name="satuan" id="satuan" type="text" class="form-control" disabled="" value="" placeholder="satuan" required="">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Harga</label>
                <div class="input-group">
                  <span class="input-group-addon">Rp</span>
                  <input name="price" id="price" type="number" class="form-control" value="" placeholder="0" required>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Diskon</label>
                <div class="input-group">
                  <span class="input-group-addon">Rp</span>
                  <input name="disc" id="disc" type="number" class="form-control" value="" placeholder="0">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-8">
              
            </div>
            
          </div>

          
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
          </form>
    </div>
  </div>
</div>
<!-- end modal  -->

<div class="modal fade" id="finish" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Selesaikan Proses</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="/jual/finish/{{$data_jual->id}}" method="GET">
            {{csrf_field()}}
        @if(count($data_jual->details) == 0)
        <div class="form-group">
          <label style="color:red">Warning !!!</label>
          <p>Silahkan <STRONG>Tambah Data</STRONG> Terlebih Dahulu</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Kembali</button>
          </form>
        </div>
        @else
        <div class="form-group">
          <label align="middle" style="color:red">Warning !!!</label>
          <p>Apakah Barang Sudah Diterima Dengan <strong>Baik dan Benar ?</strong></p>
          <p></p>
          <p>Proses yang Telah Diselesaikan tidak bisa <strong>diubah</strong> kembali.</p>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
        <button type="submit" class="btn btn-primary">Ya</button>
        </form>
      </div>
        @endif
      </div>
    </div>
  </div>
</div>