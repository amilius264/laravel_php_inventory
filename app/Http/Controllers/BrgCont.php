<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\barang;
use App\suplier;
use App\satuan;

class BrgCont extends Controller
{
   public function index(Request $Request) 
    {
            $data_barang= barang::all();   
            $data_sup= suplier::all();   
            $data_sat= satuan::all();   
            $judul = 'Data Barang';
    	
    	return view('barang.index',compact('data_barang','data_sup','data_sat','judul'));
    }

    public function create(Request $Request) 
    {   
        $pesan = [
        'required' => ':attribute wajib diisi',
        'min' => ':attribute harus diisi minimal :min karakter',
        'unique' => 'data sudah ada',
        ];

        $this->validate($Request, [
            'kode_brg' => 'min:4|unique:barang',
            'nama_brg' => 'unique:barang',
            'suplier_id' => 'required',
            'satuan_id' => 'required'
        ], $pesan);

        // $barang = \App\barang::create($Request->all());
        $barang = new barang;
        $barang->kode_brg = $Request->input('kode_brg');
        $barang->nama_brg = $Request->input('nama_brg');
        $barang->stok = '0';
        $barang->min_stok = $Request->input('min_stok');
        $barang->harga = $Request->input('harga');
        $barang->satuan_id = $Request->input('satuan_id');
        $barang->suplier_id = $Request->input('suplier_id');
        $barang->note = $Request->input('note');
        $barang->save();

        \Session::flash('sukses','Data Berhasil Ditambahkan');    
         

    	return redirect('barang');
    }

     public function edit($id)
    {   
        $barang = barang::find($id);
        $data_sat= satuan::all();   
        $data_sup= suplier::all();    
        $judul = 'Edit Data Barang';

        return view('barang.edit',compact('barang','data_sup','data_sat','judul'));
        // dd($barang);
    }

    public function update(Request $Request,$id)
    {
        $barang = barang::find($id);
        $barang->update($Request->all());
        return redirect('barang')->with('sukses','Data Berhasil Diubah');   
    }

    public function delete($id)
    {
        $barang = barang::find($id);
        $barang->delete();
        return redirect('barang')->with('sukses','Data Berhasil Dihapus');   
    }

}
