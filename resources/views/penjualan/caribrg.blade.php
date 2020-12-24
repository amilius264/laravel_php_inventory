<!-- modal -->
<div class="modal fade" id="modal-item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="modal-itemLabel">Cari Barang</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <div class="modal-body">
          <table id="mytable" class="table table-hover table-responsive">
            <thead>
              <tr>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Satuan</th>
                <th>Harga Beli</th>
                <th>Catatan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
            @foreach($data_barang as $brg)
              <tr>
                <td>{{$brg->nama_brg}}</td>
                <td>{{$brg->stok}}</td>
                <td>{{$brg->satuan->nama_sat}}</td>
                <td>Rp {{number_format($brg->harga,0,'.','.')}}</td>
                <td>{{$brg->note}}</td>
                <td>
                  <button class="btn btn-primary btn-sm" id="select" 
                      data-id="{{$brg->id}}"
                      data-nama="{{$brg->nama_brg}}"
                      data-satuan_id="{{$brg->satuan_id}}"
                      data-satuan="{{$brg->satuan->nama_sat}}"
                      data-harga="{{$brg->harga}}">
                      <!-- data-stok="{{$brg->stok}}" -->

                  <i class="fa fa-check">Pilih</i>
                  </button> 
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>                    
        </div>
          <div class="modal-footer">
          </div>
    </div>
  </div>
</div>
<!-- end modal -->
