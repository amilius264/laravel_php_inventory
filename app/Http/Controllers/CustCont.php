<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\customer;

class CustCont extends Controller
{
    public function index(Request $Request) 
    {
        $data_cust = customer::all();
        $judul = 'Data Customer';
                	
    	return view('customer.index',compact('data_cust','judul'));
    }

    public function create(Request $Request)
    	{

    	customer::create($Request->all());

        return redirect('customer')->with('sukses','Data Berhasil Ditambahkan');
    	}

    public function edit($id)
    {
    	$cust = customer::find($id);
        $judul = 'Edit Data Customer';

    	return view('customer.edit',compact('cust','judul'));
    }

    public function update(Request $Request,$id)
    {
    	$cust = customer::find($id);
    	$cust->update($Request->all());
    	return redirect('customer')->with('sukses','Data Berhasil Diubah');	
    }

    public function delete($id)
    {
        $cust = customer::find($id);
        $cust->delete();
        return redirect('customer')->with('sukses','Data Berhasil Dihapus');   
    }
}
