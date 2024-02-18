<?php

namespace App\Http\Controllers;

use App\Models\pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class pegawaiAjaxcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = pegawai::orderBy('nama','asc');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('aksi', function($data){
            return view('pegawai.tombol')->with('data', $data);
        })
        ->make(true);
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
        $validasi = Validator::make($request->all(),[
            'nama' =>'required',
            'email' => 'required|email',
        ], [
            'nama.required' => 'Nama Wajib Di isi',
            'email.required' => 'Email Wajib Di isi',
            'email.email' => 'Format Email Wajib Benar',
        ]);
        if ($validasi->fails()) {
            return response()->json(['errors' =>$validasi->errors()]);
        } else {
            $data = [
                'nama' => $request->nama,
                'email' => $request->email
            ];
            pegawai::create($data);
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
        $data = pegawai::where('id', $id)->first();
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
        $validasi = Validator::make($request->all(),[
            'nama' =>'required',
            'email' => 'required|email',
        ], [
            'nama.required' => 'Nama Wajib Di isi',
            'email.required' => 'Email Wajib Di isi',
            'email.email' => 'Format Email Wajib Benar',
        ]);
        if ($validasi->fails()) {
            return response()->json(['errors' =>$validasi->errors()]);
        } else {
            $data = [
                'nama' => $request->nama,
                'email' => $request->email
            ];
            pegawai::where('id',$id)->update($data);
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
        pegawai::where('id',$id)->delete();
    }
}