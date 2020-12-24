<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Satuan;
use App\t_status;

class SatCont extends Controller
{
    public function index(Request $Request) 
    {
        $data_satuan = satuan::all();
        $judul = 'Data Satuan';
    	
    	return view('Satuan.index',compact('data_satuan','judul'));
    }

    public function create(Request $Request) 
    {
    	satuan::create($Request->all());

    	return redirect('satuan')->with('sukses','Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
    	$satuan = satuan::find($id);
        $judul = 'Data Satuan';

    	return view('satuan.edit',compact('satuan','judul'));
    }

    public function update(Request $Request,$id)
    {
    	$satuan = satuan::find($id);
    	$satuan->update($Request->all());
        
    	return redirect('satuan')->with('sukses','Data Berhasil Diubah');	
    }

    public function delete($id)
    {
        $satuan = satuan::find($id);
        $satuan->delete();
        return redirect('satuan')->with('sukses','Data Berhasil Dihapus');   
    }

    public function indexstat(Request $Request) 
    {
        $stat = t_status::all();
        $judul = 'Data Status';
        
        return view('Satuan.status',compact('stat','judul'));
    }

    public function createstat(Request $Request) 
    {
        t_status::create($Request->all());

        \Session::flash('sukses','Data Berhasil Ditambah');   

        return redirect()->back();
    }
}
