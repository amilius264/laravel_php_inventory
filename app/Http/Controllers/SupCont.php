<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\suplier;

class SupCont extends Controller
{
    public function index(Request $Request) 
    {
        $data_sup= suplier::all();     
        $judul = 'Data Supplier';
    	
    	return view('suplier.index',compact('data_sup','judul'));
    }

    public function create(Request $Request) 
    {
    	suplier::create($Request->all());

    	return redirect('suplier')->with('sukses','Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
    	$suplier = suplier::find($id);
        $judul = 'Edit Data Supplier';

    	return view('suplier.edit',compact('suplier','judul'));
    }

    public function update(Request $Request,$id)
    {
    	$suplier = suplier::find($id);
    	$suplier->update($Request->all());

        \Session::flash('sukses','Data Berhasil Diubah');
    	return redirect('suplier');
    }

    public function delete($id)
    {
        $suplier = suplier::find($id);
        $suplier->delete();
        return redirect('suplier')->with('sukses','Data Berhasil Dihapus');   
    }
}
