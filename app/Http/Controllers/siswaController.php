<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class siswaController extends Controller
{
    public function index(Request $Request) 
    {
        if($Request->has('cari')){
            $data_siswa = \App\siswa::where('nama_lengkap','LIKE','%'.$Request->cari.'%')->get();
        }else{
            $data_siswa = \App\siswa::all();     
        }
    	
    	return view('siswa.index',['data_siswa' => $data_siswa]);
    }
    public function create(Request $Request) 
    {
    	\App\siswa::create($Request->all());

    	return redirect('\siswa')->with('sukses','Data Berhasil Ditambahkan');
    }
    public function edit($id)
    {
    	$siswa = \App\siswa::find($id);
    	return view('siswa/edit',['siswa' => $siswa]);
    }
    public function update(Request $Request,$id)
    {
    	$siswa = \App\siswa::find($id);
    	$siswa->update($Request->all());
    	return redirect('\siswa')->with('sukses','Data Berhasil Diubah');	
    }
    public function delete($id)
    {
        $siswa = \App\siswa::find($id);
        $siswa->delete();
        return redirect('\siswa')->with('sukses','Data Berhasil Dihapus');   
    }
}
