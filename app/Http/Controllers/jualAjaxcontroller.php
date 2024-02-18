<?php

namespace App\Http\Controllers;

use App\Models\penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class jualAjaxcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = penjualan::orderBy('namabarang','asc');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('aksi', function($data){
            return view('penjualan.tombol')->with('data', $data);
        })
        ->editColumn("totalharga", function($data) {
            $total = $data->hargasatuan * $data->jumlahbarang;
            return "Rp. ".number_format($total);
        })
        ->make(true);

        return view('penjualan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validasi = validator::make($request->all(),[
            'namabarang' => 'required',
            'jenisbarang' => 'required',
            'hargasatuan' => 'required',
            'jumlahbarang' => 'required',
        ], [
            'namabarang.required' => 'Masukan Nama Barang',
            'jenisbarang.required' => 'Masukan Jenis Barang',
            'hargasatuan.required' => 'Masukan Harga Satuan',
            'jumlahbarang.required' => 'Masukan Jumlah Barang Penjualan',
        ]);

        if($validasi->fails()) {
            return response()->json(['errors' =>$validasi->errors()]);
        } else {
            $data = [
                'namabarang' => $request->namabarang,
                'jenisbarang' => $request->jenisbarang,
                'hargasatuan' => $request->hargasatuan,
                'jumlahbarang' => $request->jumlahbarang,
                'totalharga' => $request->totalharga
            ];
            penjualan::create($data);
            return response()->json(['success' =>"Data Berhasil Disimpan"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = penjualan::where('id', $id)->first();
        return response()->json(['result' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validasi = validator::make($request->all(),[
            'namabarang' => 'required',
            'jenisbarang' => 'required',
            'hargasatuan' => 'required',
            'jumlahbarang' => 'required',
        ], [
            'namabarang.required' => 'Masukan Nama Barang',
            'jenisbarang.required' => 'Masukan Jenis Barang',
            'hargasatuan.required' => 'Masukan Harga Satuan',
            'jumlahbarang.required' => 'Masukan Jumlah Barang Penjualan',
        ]);
        if($validasi->fails()) {
            return response()->json(['errors' =>$validasi->errors()]);
        } else {
            $data = [
                'namabarang' => $request->namabarang,
                'jenisbarang' => $request->jenisbarang,
                'hargasatuan' => $request->hargasatuan,
                'jumlahbarang' => $request->jumlahbarang,
                'totalharga' => $request->totalharga
            ];
            penjualan::where('id', $id)->update($data);
            return response()->json(['success' =>"Data Berhasil DiUbah"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
