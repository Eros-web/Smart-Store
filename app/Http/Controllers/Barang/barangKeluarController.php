<?php

namespace App\Http\Controllers\Barang;

use App\Http\Controllers\Controller;
use App\Models\barangKeluar;
use App\Models\pelanggan;
use App\Models\stok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class barangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = barangKeluar::with('getUser', 'getPelanggan', 'getStok');

        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('tanggal_faktur', [
                    $request->tanggal_awal,
                    $request->tanggal_akhir, 
                ]
            );
        }

        $query->orderBy('created_at', 'desc');

        $getBarangKeluar = $query->paginate(10);

        $getTotalPendapatan = barangKeluar::sum('sub_total');

        return view('Barang.BarangKeluar.barangKeluar', compact(
            'getBarangKeluar',
            'getTotalPendapatan'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = barangKeluar::all();
        $lastId = barangKeluar::max('id');
        $lastId = $lastId ? $lastId : 0;

        // Handle case where there is no data yet
        if ($data->isEmpty()) {
            $nextId = $lastId + 1;
            $date = now()->format('d/m/y');
            $kode_transaksi = 'TRK' . $nextId . '/' . $date;
            $pelanggan = pelanggan::all();

            return view('Barang.BarangKeluar.add-barang-keluar', compact(
                'data',
                'kode_transaksi',
                'pelanggan'
            ));
        }

        $latestItem = barangKeluar::latest()->first();
        $id = $latestItem->id;
        $date = $latestItem->created_at->format('d/m/y');
        $kode_transaksi = 'TRK' . ($id + 1) . '/' . $date;
        $pelanggan = pelanggan::all();

        return view('Barang.BarangKeluar.add-barang-keluar', compact(
            'data',
            'kode_transaksi',
            'pelanggan'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tgl_faktur' => 'required',
            'tgl_jatuh_tempo' => 'required',
            'pelanggan_id' => 'required',
            'jenis_pembayaran' => 'required',
        ], [
            'required' => ': Attribut wajib diisi'
        ]);

        $kode_transaksi = $request->kode_transaksi;
        $tgl_faktur = $request->tgl_faktur;
        $tgl_jatuh_tempo = $request->tgl_jatuh_tempo;
        $pelanggan_id = $request->pelanggan_id;

        $getnamaPelanggan = pelanggan::find($pelanggan_id);
        $namaPelanggan = $getnamaPelanggan->nama_pelanggan;
        $jenis_pembayaran = $request->jenis_pembayaran;

        $getBarang = stok::all();

        return view('Transaksi.transaksi', compact(
            'kode_transaksi',
            'tgl_faktur',
            'tgl_jatuh_tempo',
            'pelanggan_id',
            'namaPelanggan',
            'jenis_pembayaran',
            'getBarang',
        ));
    }

    public function saveProcess(Request $request)
    {
        $request->validate([
            'kode_transaksi' => 'required',
            'tgl_faktur' => 'required',
            'tgl_jatuh_tempo' => 'required',
            'pelanggan_id' => 'required',
            'jenis_pembayaran' => 'required',
            'barang_id' => 'required',
            'jumlah_beli' => 'required',
            'harga_jual' => 'required',
        ]);

        $save = new barangKeluar();
        $save -> kode_transaksi = $request -> kode_transaksi;
        $save -> tgl_faktur = $request -> tgl_faktur;
        $save -> tgl_jatuh_tempo = $request -> tgl_jatuh_tempo;
        $save -> pelanggan_id = $request -> pelanggan_id;
        $save -> jenis_pembayaran = $request -> jenis_pembayaran;
        $save -> barang_id = $request -> barang_id;
        $save -> jumlah_beli = $request -> jumlah_beli;

            $getStokData = stok::find($request->barang_id);
                $jumlahStokBaru = $getStokData->stok;
            $getStokData->stok = $jumlahStokBaru - $request->jumlah_beli;
            $getStokData->save();

        $save -> harga_jual = $request -> harga_jual;
        
        $diskon = $request->diskon;
        $nilaiDiskon = $diskon / 100;

        if ($diskon) {
            $save -> diskon = $request -> diskon;
            $hitung = $request -> jumlah_beli * $request -> harga_jual;
            $totalDiskon = $hitung * $nilaiDiskon;
            $subTotal = $hitung - $totalDiskon;

            $save -> sub_total = $subTotal;
        } else {
            $hitung = $request -> jumlah_beli * $request -> harga_jual;
            $save -> sub_total = $hitung;
        }
        
        $save -> user_id = Auth::user()->id;
        $save -> tgl_buat = $request -> tgl_faktur;
        $save -> save();

        return redirect('/barang-keluar')->with(
            'message',
            'Barang Keluar ditambahkan'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
        // jenis_pembayaran
        // barang_id
        // jumlah_beli
        // harga_jual
        // diskon
        // sub_total
        // user_id
        // tgl_buat
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = barangKeluar::find($id);
            $getId_BK = $delete->barang_id;
            $getJumlahBarangKeluar = $delete->jumlah_beli;

                $update = stok::find($getId_BK);
                    $getStok = $update->stok;
                    $jumlahBaru = $getStok  + $getJumlahBarangKeluar;
                $update->save();

        $delete->delete();

        return redirect()->back()->with(
            'message',
            'Data Berhasi Dihapus'
        );
    }

    public function print($id)
    {
        $dataPrint = barangKeluar::with('getStok', 'getPelanggan')->find($id);
        return view('Nota.nota', compact('dataPrint'));
    }



}
