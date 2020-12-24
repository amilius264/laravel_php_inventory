<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\barang;
use App\suplier;
use App\customer;
use App\jual;
use App\jualdetail;
use App\sales;
use App\finish;

class jualCont extends Controller
{
    public function index(Request $Request) 
    {
        $data_jual = jual::withCount('details')->orderBy('tanggal_jual','desc')->get();
        $f_tgl = date('my');
        $data_cust= customer::all();
        $data_sales= sales::all();
        $tgl = date('Y-m-d');
        $judul = 'Data Penjualan';

        return view('penjualan.jual',compact('data_cust','tgl','judul','data_sales','f_tgl','data_jual'));
    }

    public function store(Request $Request)
    {
        $b = new jual;
        $b->customer_id = $Request->customer_id;
        $b->sales_id = $Request->sales_id;
        $b->status_id = 1;
        $b->tanggal_jual = $Request->tanggal_jual;
        $b->tanggal_tempo = $Request->tanggal_tempo;
        $b->faktur_no = $Request->faktur_no;
        $b->note = $Request->note;
        $b->save();

        return redirect('jual')->with('sukses','Data Berhasil Ditambahkan');
    }

    public function delete_jual($id)
    {
        $jual = jual::find($id);
        $jual->delete();

        return redirect('jual')->with('sukses','Data Berhasil Dihapus');   
    }

    public function edit($id)
    {
        $data_jual = jual::find($id);
        $data_cust = customer::all();
        $data_sales = sales::all();
        $judul = 'Edit Data Penjualan';

        return view('penjualan.editjual',compact('data_jual','data_cust','data_sales','judul'));
    }    

    public function update(Request $Request,$id)
    {
        $data_jual = jual::find($id);
        $data_jual->update($Request->all());

        return redirect('jual')->with('sukses','Data Berhasil Diubah');   
    }

    public function detail($id)
    {
        $data_jual = jual::find($id);
        $tgl_jual = date("d/m/Y", strtotime($data_jual->tanggal_jual));
        $tgl_tempo = date("d/m/Y", strtotime($data_jual->tanggal_tempo));
        $auto = str_pad(($data_jual->id),4,0,STR_PAD_LEFT);

        $jual_detail = jualdetail::all();
        $data_barang = barang::all();
        $judul = 'Detail Penjualan Barang';
        
        return view('penjualan.jual_detail',compact('data_barang', 'jual_detail', 'data_jual','judul',
                                                    'tgl_jual', 'tgl_tempo', 'auto'));
    }

    public function add_detail(Request $Request)
    {
        $bd = new jualdetail;
        $bd->jual_id = $Request->input('jual_id');
        $bd->barang_id = $Request->input('id');
        $bd->satuan_id = $Request->input('satuan_id');
        $bd->qty = $Request->input('qty');
        $bd->price = $Request->input('price');
        $bd->disc = $Request->input('disc');
        $bd->total = ($bd->qty*$bd->price) - $bd->disc;
        $bd->save();

        \Session::flash('sukses','Data Berhasil Ditambah');   

        return redirect()->back();
    }

    public function delete_detail($id)
    {
        try {
            jualdetail::where('id',$id)->delete();

            \Session::flash('sukses','Data Berhasil Dihapus');   
        } catch (\Exception $e) {
            \Session::flash('gagal', $e->getMessage());
        }
        return redirect()->back();
    }

    public function update_detail(Request $Request, $id)
    {
        $qty = $Request->qty;
        $price = $Request->price;
        $disc = $Request->disc;
        $barang_id = $Request->barang_id;
        $jual_id = $Request->jual_id;
        $detail_id = $Request->jualdetail_id;
        $ppn = $Request->ppn;
        $total_s = $Request->total_s;

        jual::where('id',$id)->update([
            'ppn'=>$ppn,
            'g_total'=>$total_s
        ]);

        foreach ($qty as $e => $data_jual) {
            $data['qty'] = $data_jual;
            $data ['disc'] = $disc[$e];
            $data ['price'] = $price[$e];
            $data ['total'] = ($data_jual * $price[$e]) - $disc[$e];
            $id = $detail_id[$e];

            jualdetail::where('id',$id)->update($data);
        }

        \Session::flash('sukses','Data Berhasil Diubah');     

        return redirect()->back();
    }

    public function finish($id)
    {
        $data = jual::find($id);

        jual::where('id',$id)->update([
            'status_id'=>2
        ]);

        \DB::transaction(function()use($id, $data){
            jual::where('id',$id)->update([
            'status_id'=>2
            ]);

            foreach ($data->details as $ln) {
                $qty = $ln->qty;
                $brg = $ln->barang_id;

                $pd = barang::find($brg);
                $stok_skrg = $pd->stok;
                $stok_baru = $stok_skrg - $qty;

                barang::where('id',$brg)->update([
                    'stok'=>$stok_baru
                ]);
            }
        });

        \Session::flash('sukses','Data Berhasil Di Selesaikan');   

        return redirect('jual');   
    }    
}
