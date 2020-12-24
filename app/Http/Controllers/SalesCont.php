<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sales;

class SalesCont extends Controller
{
    public function index(Request $Request) 
    {
        $data_sales = sales::all();   
        $judul = 'Data Sales';
                	
    	return view('sales.index',compact('data_sales','judul'));
    }

    public function create(Request $Request)
    	{

    	$sales = new sales;
        $sales->nama_sales = $Request->input('nama_sales');
        $sales->kontak = $Request->input('kontak');
        $sales->alamat = $Request->input('alamat');
        $sales->aktif = 'Aktif';
        $sales->save();

        return redirect('sales')->with('sukses','Data Berhasil Ditambahkan');
    	}

    public function edit($id)
    {
    	$sales = sales::find($id);
        $judul = 'Edit Data Sales';

    	return view('sales.edit',compact('sales','judul'));
    }

    public function update(Request $Request,$id)
    {
    	$sales = sales::find($id);
    	$sales->update($Request->all());

    	return redirect('sales')->with('sukses','Data Berhasil Diubah');	
    }

    public function delete($id)
    {
        $sales = sales::find($id);
        $sales->delete();
        return redirect('sales')->with('sukses','Data Berhasil Dihapus');   
    }

}
