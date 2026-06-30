<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event; // Memastikan Model Event dipanggil dengan benar

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard utama.
     */
    public function index()
    {
        // KUNCI PERBAIKAN: 
        // Kita gunakan ->get() tanpa ->take(2) atau ->limit(2) 
        // Ini memastikan SEMUA data event di database ditarik tanpa batasan jumlah.
        $events = Event::with('user')
                       ->orderBy('start_date', 'asc')
                       ->get();

        // Mengirimkan semua data event ke view dashboard
        return view('dashboard', compact('events'));
    }
}