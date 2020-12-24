<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\belidetail_temps;

class BeliTempCont extends Controller
{
    public function create(Request $request)
	{
		$pesan = [
            'required' => 'Data harus diisi',
            'min' => ':attribute harus diisi minimal :min karakter',
            'unique' => 'Data sudah ada',
        ];

        $this->validate($request, [
            'nama_brg' => 'required|unique',
            'suplier_id' => 'required',
        ], $pesan);


		$belitemps = new belidetail_temps;
		$belitemps->barang_id = $request->input('id');
		$belitemps->Temp_price = $request->input('Temp_price');
		$belitemps->Temp_jumlah = $request->input('Temp_jumlah');
		$belitemps->satuan_id = $request->input('satuan_id');
		$belitemps->save();

		return redirect('beli');
	}

	
}
