<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suplier;
use App\Models\Pelanggan;
use App\Models\Stok;
use App\Models\BarangKeluar;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSuplier = Suplier::count();
        $totalPelanggan = Pelanggan::count();
        $totalStok = Stok::count();
        $totalPendapatan = BarangKeluar::sum('sub_total');

        return view('Dashboard.dashboard', compact(
            'totalSuplier',
            'totalPelanggan',
            'totalStok',
            'totalPendapatan'
        ));
    }
}