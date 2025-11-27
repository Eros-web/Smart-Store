<?php

namespace App\Http\Controllers;

use App\Models\suplier;
use Illuminate\Http\Request;

class suplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tampungCari = $request->input('search');

        $data = suplier::where('nama_suplier', 'like', '%' . $tampungCari . '%')
        ->orWhere('telp', 'like', '%' . $tampungCari . '%')
        ->orderBy('tgl_terdaftar', 'desc')
        ->paginate();
        
        return view('Suplier.suplier', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Suplier.add-suplier');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_suplier' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'email' => 'required|email',
            'tgl_terdaftar' => 'required|date',
            'status' => 'required',
        ], [
            'required' => 'Data wajib diisi!',
            'email' => 'Format email tidak valid!',
            'date' => 'Format tanggal tidak valid!',
        ]);

        $suplier = new suplier();
        $suplier->nama_suplier = $request->nama_suplier;
        $suplier->alamat = $request->alamat;
        $suplier->telp = $request->telp;
        $suplier->email = $request->email;
        $suplier->tgl_terdaftar = $request->tgl_terdaftar;
        $suplier->status = $request->status;
        $suplier->save();

        return redirect('/suplier')->with('message', 'Data Suplier Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $getData = suplier::find($id);
        return view('Suplier.edit-suplier', compact('getData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_suplier' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'email' => 'required|email',
            'tgl_terdaftar' => 'required|date',
            'status' => 'required',
        ], [
            'required' => 'Data wajib diisi!',
            'email' => 'Format email tidak valid!',
            'date' => 'Format tanggal tidak valid!',
        ]);

        $suplier = suplier::find($id);
        $suplier->nama_suplier = $request->nama_suplier;
        $suplier->alamat = $request->alamat;
        $suplier->telp = $request->telp;
        $suplier->email = $request->email;
        $suplier->tgl_terdaftar = $request->tgl_terdaftar;
        $suplier->status = $request->status;
        $suplier->save();

        return redirect('/suplier')->with('message', 'Data Suplier Berhasil Diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = suplier::find($id);
        $data->delete();

        return redirect()->back()->with(
            'message', 
            'Data Suplier Berhasil Dihapus!'
        );
    }
}
