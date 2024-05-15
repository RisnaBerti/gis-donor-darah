<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\StokDarah;
use App\Models\JenisDarah;
use App\Models\Order;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SearchController extends Controller
{
    public function index() {

        $orders = Order::with(['pencari', 'pendonor'])->get();
        return view('order.index', compact('orders'));
    }

    public function approve($id) {
        // Temukan order berdasarkan ID
        $order = Order::findOrFail($id);
    
        // Ubah status order menjadi "Approved"
        $order->status = 'Approved';
        $order->save();
    
        // Kirim pesan sukses kembali ke view
        return redirect()->back()->with('success', 'Permintaan donor darah berhasil disetujui.');
    }
    

    public function reject($id) {
        // Temukan order berdasarkan ID
        $order = Order::findOrFail($id);
    
        // Ubah status order menjadi "Rejected"
        $order->status = 'Rejected';
        $order->save();
    
        // Kirim pesan sukses kembali ke view
        return redirect()->back()->with('success', 'Permintaan donor darah berhasil ditolak.');
    }
    
    
}
