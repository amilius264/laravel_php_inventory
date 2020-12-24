<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\finish;
use App\barang;
use App\beli;
use App\belidetail;
use App\jual;
use App\jualdetail;
use App\customer;
use PDF;

class finishCont extends Controller
{
    public function indexbuy(Request $Request) 
    {
        $data_beli = beli::withCount('lines')->orderBy('tanggal_beli','desc')->get();
        $beli_detail = belidetail::all();
        $tgl = date('Y-m-d');
        $judul = 'Laporan Data Pembelian';

        return view('report.buy_report',compact('data_beli','beli_detail','tgl','judul'));
    }

    public function indexsell(Request $Request) 
    {
        $data_jual = jual::withCount('details')->orderBy('tanggal_jual','desc')->get();
        $jual_detail = jualdetail::all();
        $tgl = date('Y-m-d');
        $judul = 'Laporan Data Penjualan';

        return view('report.sell_report',compact('data_jual','jual_detail','tgl','judul'));
    }

    public function sell_detail($id)
    {
        $data_jual = jual::find($id);
        $tgl_jual = date("d/m/Y", strtotime($data_jual->tanggal_jual));
        $tgl_tempo = date("d/m/Y", strtotime($data_jual->tanggal_tempo));
        $auto = str_pad(($data_jual->id),4,0,STR_PAD_LEFT);
        
        $jual_detail = jualdetail::all();
        $data_barang = barang::all();
        $judul = 'Detail Penjualan Barang';
        
        return view('report.sell_detail',compact('data_barang', 'jual_detail', 'data_jual','judul', 'tgl_jual',
                                                    'tgl_tempo', 'auto'));
    }

    public function exportpdf($id)
    {
        $jual = jual::with('customer')->find($id);
        $tgl_jual = date("d/m/Y", strtotime($jual->tanggal_jual));
        $tgl_tempo = date("d/m/Y", strtotime($jual->tanggal_tempo));
        $auto = str_pad(($jual->id),4,0,STR_PAD_LEFT);

        $pdf = PDF::loadview('report.pdf', compact('jual','auto','tgl_jual','tgl_tempo'))->setPaper('a4','portrait');
        return $pdf->stream();
    }
}
