<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\belidetail_temps;
use App\barang;
use App\belidetail;
use App\beli;
use App\finish;
use App\suplier;
use App\t_status;

class BeliCont extends Controller
{
	public function index(Request $Request) 
    {
        $data_beli = beli::withCount('lines')->orderBy('tanggal_beli','desc')->get();
    	$data_sup= suplier::all();
        $beli_detail = belidetail::all();
        $tgl = date('Y-m-d');
        $judul = 'Data Pembelian';

    	return view('pembelian.beli',compact('data_sup','data_beli','beli_detail','tgl','judul'));
    }

    public function store(Request $Request)
    {
        $b = new beli;
        $b->suplier_id = $Request->suplier_id;
        $b->status = 1;
        $b->tanggal_beli = $Request->tanggal_beli;
        $b->noinv = $Request->noinv;
        $b->note = $Request->note;
        $b->save();

        return redirect('beli')->with('sukses','Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $data_beli = beli::find($id);
        $data_sup= suplier::all();
        $judul = 'Edit Data Pembelian';

        return view('pembelian.editbeli',compact('data_beli','data_sup','judul'));
    }    

    public function update(Request $Request,$id)
    {
        $data_beli = beli::find($id);
        $data_beli->update($Request->all());

        return redirect('beli')->with('sukses','Data Berhasil Diubah');   
    }

    public function delete_beli($id)
    {
        $beli = beli::find($id);
        $beli->delete();

        return redirect('beli')->with('sukses','Data Berhasil Dihapus');   
    }

    public function detail($id)
    {
        
        $data_beli = beli::find($id);
        $tgl_beli = date("d/m/Y", strtotime($data_beli->tanggal_beli));
        $beli_detail = belidetail::all();
        $data_barang = barang::all();
        $judul = 'Detail Pembelian Barang';
        // $tgl = date('d-m-Y');
        
        return view('pembelian.beli_detail',compact('data_barang', 'beli_detail', 'data_beli','judul', 'tgl_beli'));
    }

    public function add_detail(Request $Request)
    {
        $bd = new belidetail;
        $bd->beli_id = $Request->input('beli_id');
        $bd->barang_id = $Request->input('id');
        $bd->satuan_id = $Request->input('satuan_id');
        $bd->jumlah = $Request->input('jumlah');
        $bd->price = $Request->input('harga');
        $bd->total = $bd->jumlah * $bd->price;
        $bd->save();

        \Session::flash('sukses','Data Berhasil Ditambah');   

        return redirect()->back();
    }

    public function delete_detail($id)
    {
        try {
            belidetail::where('id',$id)->delete();

            \Session::flash('sukses','Data Berhasil Dihapus');   
        } catch (\Exception $e) {
            \Session::flash('gagal', $e->getMessage());
        }
        return redirect()->back();
    }
    
    public function update_detail(Request $Request, $id)
    {
        try {
            $jumlah = $Request->jumlah;
            $price = $Request->price;
            $barang_id = $Request->barang_id;
            $detail_id = $Request->belidetail_id;

            foreach ($jumlah as $e => $data_beli) {
                $data['jumlah'] = $data_beli;
                $data ['price'] = $price[$e];
                $data ['total'] = $data_beli * $price[$e];
                $id = $detail_id[$e];

                belidetail::where('id',$id)->update($data);

                barang::where('id',$barang_id[$e])->update([
                    'harga'=>$data['price']
                ]);
            }

            \Session::flash('sukses','Data Berhasil Diubah');   
           } catch (\Exception $e) {
            \Session::flash('gagal', $e->getMessage());
           }   

        return redirect()->back();
    }

    public function finish($id)
    {
        $data = beli::find($id);

        beli::where('id',$id)->update([
            'status'=>2
        ]);

        \DB::transaction(function()use($id, $data){
            beli::where('id',$id)->update([
            'status'=>2
            ]);

            foreach ($data->lines as $ln) {
                $qty = $ln->jumlah;
                $brg = $ln->barang_id;

                $pd = barang::find($brg);
                $stok_skrg = $pd->stok;
                $stok_baru = $stok_skrg + $qty;

                barang::where('id',$brg)->update([
                    'stok'=>$stok_baru
                ]);
            }
        });

        // finish::where('beli_id',$id)->delete();

        // finish::insert([
        //     'beli_id'=>$id,
        //     'status'=>2,
        //     'created_at'=>date('Y-m-d H:i:s'),
        //     'updated_at'=>date('Y-m-d H:i:s')
        // ]);

        \Session::flash('sukses','Data Berhasil Di Selesaikan');   

        return redirect()->back();
    }    

}
