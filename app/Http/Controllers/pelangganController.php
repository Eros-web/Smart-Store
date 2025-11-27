<?php

namespace App\Http\Controllers;

use App\Models\pelanggan;
use Illuminate\Http\Request;

class pelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pelanggan = pelanggan::where('nama_pelanggan', 'like', "%$search%")
        ->orWhere('telp', 'like', "%$search%")
        ->paginate(5);

        return view('Pelanggan.pelanggan', compact('pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Pelanggan.add-pelanggan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pelangganValidate = $request->validate([
            'nama_pelanggan' => 'required',
            'telp' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
        ], [
            'required' => 'Bagian ini wajib diisi',
        ]);

        pelanggan::create($pelangganValidate);
        return redirect('/pelanggan')->with('message', 'Data pelanggan berhasil ditambahkan');

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
        $getData = pelanggan::find($id);
        return view('Pelanggan.edit-pelanggan', compact(
            'getData'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pelangganValidate = $request->validate([
            'nama_pelanggan' => 'required',
            'telp' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
        ], [
            'required' => 'Bagian ini wajib diisi',
        ]);

        $update = pelanggan::find($id);
        $update->update($pelangganValidate);

        return redirect('/pelanggan')->with('message', 'Data pelanggan berhasil diubah');   

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = pelanggan::find($id);
        $delete->delete();

        return redirect()->back()->with('message', 'Data pelanggan berhasil dihapus');
    }
}
