<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\StokDarah;
use App\Models\JenisDarah;

class PanelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $markPendonor = [];

        // Misalkan Anda memiliki data dari tabel 'profiles'
        $profiles = User::role('pendonor')->with('profile')->get();

        foreach ($profiles as $profile) {
            $icon = '';

             // Tentukan ikon berdasarkan golongan darah
            switch ($profile->profile->golongan_darah) {
                case 'A':
                    $icon = asset('img/a.png');
                    break;
                case 'B':
                    $icon = asset('img/b.png');
                    break;
                case 'AB':
                    $icon = asset('img/ab.png');
                    break;
                case 'O':
                    $icon = asset('img/o.png');
                    break;
                default:
                    $icon = asset('img/default.png'); // Ikon default jika golongan darah tidak dikenal
                    break;
            }

            $markPendonor[] = [
                'position' => [
                    'lat' => floatval($profile->profile->lat),
                    'lng' => floatval($profile->profile->long),
                ],
                'label' => [                   
                    
                ],
                'icon' => $icon,
                'draggable' => false,
            ];
        }

        return view('front.index', compact('markPendonor'));
    }

    public function stokDarah()
    {
        // Query untuk mengambil data stok darah sesuai dengan struktur yang telah disesuaikan sebelumnya
        $stoks = StokDarah::join('jenis_darah', 'stok_darah.jenis_id', '=', 'jenis_darah.id')
            ->selectRaw("jenis_darah.kategori AS jenis_produk")
            ->selectRaw("SUM(CASE WHEN jenis_darah.goldar = 'A' THEN stok_darah.jumlah ELSE 0 END) AS A")
            ->selectRaw("SUM(CASE WHEN jenis_darah.goldar = 'B' THEN stok_darah.jumlah ELSE 0 END) AS B")
            ->selectRaw("SUM(CASE WHEN jenis_darah.goldar = 'O' THEN stok_darah.jumlah ELSE 0 END) AS O")
            ->selectRaw("SUM(CASE WHEN jenis_darah.goldar = 'AB' THEN stok_darah.jumlah ELSE 0 END) AS AB")
            ->selectRaw("SUM(stok_darah.jumlah) AS Subtotal")
            ->groupBy('jenis_darah.kategori')
            ->orderBy('jenis_darah.id')
            ->get();

        // Mengirimkan data ke view 'front.stock'
        return view('front.stock', compact('stoks'));
    }


}
