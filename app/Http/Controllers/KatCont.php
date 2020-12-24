<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KatCont extends Controller
{
    public function index(Request $Request) 
    {
    //     if($Request->has('cari')){
    //         $data_kategori = \App\kategori::where('nama_kat','LIKE','%'.$Request->cari.'%')->get();
        // }else{
            $data_kategori= \App\kategori::all();     
        // }
    	
    	return view('Kategori.index',['data_kategori' => $data_kategori]);
            // retur view
    }

    public function create(Request $Request) 
    {
    	\App\kategori::create($Request->all());

    	return redirect('kategori')->with('sukses','Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
    	$kategori = \App\kategori::find($id);
    	return view('kategori/edit',['kategori' => $kategori]);
    }

    public function update(Request $Request,$id)
    {
    	$kategori = \App\kategori::find($id);
    	$kategori->update($Request->all());
    	return redirect('kategori')->with('sukses','Data Berhasil Diubah');	
    }

    public function delete($id)
    {
        $kategori = \App\kategori::find($id);
        $kategori->delete();
        return redirect('kategori')->with('sukses','Data Berhasil Dihapus');   
    }
}
