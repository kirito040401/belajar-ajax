<?php

namespace App\Http\Controllers;

use App\Models\buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class bukuAjaxcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = buku::orderBy('namabuku','asc');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('aksi', function($data){
            return view('buku.tombol')->with('data', $data);
        })
        ->make(true);

        return view('buku.index');
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
            'namabuku' =>'required',
            'tglbuku' => 'required',
            'stok' => 'required',
        ], [
            'namabuku.required' => 'Nama buku Wajib Di isi',
            'tglbuku.required' => 'tanggal Wajib Di isi',
            'stok.email' => 'stok Wajib Di isi',
        ]);
        if ($validasi->fails()) {
            return response()->json(['errors' =>$validasi->errors()]);
        } else {
            $data = [
                'namabuku' => $request->namabuku,
                'tglbuku' => $request->tglbuku,
                'stok' => $request->stok
            ];
            buku::create($data);
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
        $data = buku::where('id', $id)->first();
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
            'namabuku' =>'required',
            'tglbuku' => 'required',
            'stok' => 'required',
        ], [
            'namabuku.required' => 'Nama buku Wajib Di isi',
            'tglbuku.required' => 'tanggal Wajib Di isi',
            'stok.email' => 'stok Wajib Di isi',
        ]);
        if ($validasi->fails()) {
            return response()->json(['errors' =>$validasi->errors()]);
        } else {
            $data = [
                'namabuku' => $request->namabuku,
                'tglbuku' => $request->tglbuku,
                'stok' => $request->stok
            ];
            buku::where('id', $id)->update($data);
            return response()->json(['success' =>"Data Berhasil Diubah"]);
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
        buku::where('id', $id)->delete();
    }
}
