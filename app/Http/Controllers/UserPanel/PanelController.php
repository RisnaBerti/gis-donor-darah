<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\StokDarah;
use App\Models\JenisDarah;
use App\Models\Order;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


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
                'title' => $profile->profile->nama,
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
            ->selectRaw("JSON_OBJECT('jumlah', SUM(CASE WHEN jenis_darah.goldar = 'A' THEN stok_darah.jumlah ELSE 0 END), 'id', MAX(CASE WHEN jenis_darah.goldar = 'A' THEN stok_darah.id ELSE NULL END)) AS A")
            ->selectRaw("JSON_OBJECT('jumlah', SUM(CASE WHEN jenis_darah.goldar = 'B' THEN stok_darah.jumlah ELSE 0 END), 'id', MAX(CASE WHEN jenis_darah.goldar = 'B' THEN stok_darah.id ELSE NULL END)) AS B")
            ->selectRaw("JSON_OBJECT('jumlah', SUM(CASE WHEN jenis_darah.goldar = 'O' THEN stok_darah.jumlah ELSE 0 END), 'id', MAX(CASE WHEN jenis_darah.goldar = 'O' THEN stok_darah.id ELSE NULL END)) AS O")
            ->selectRaw("JSON_OBJECT('jumlah', SUM(CASE WHEN jenis_darah.goldar = 'AB' THEN stok_darah.jumlah ELSE 0 END), 'id', MAX(CASE WHEN jenis_darah.goldar = 'AB' THEN stok_darah.id ELSE NULL END)) AS AB")
            ->selectRaw("SUM(stok_darah.jumlah) AS Subtotal")
            ->groupBy('jenis_darah.kategori')
            ->orderBy('jenis_darah.id')
            ->get();

            
            
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::id();
    
        $history = Order::with(['pencari'])->where('pencari_id', $userId)->where('sumber', 'Stok')->orderBy('created_at', 'DESC')->get();
        
        return view('front.stock', compact('stoks', 'history'));
    }

    public function requestStok(Request $request)
    {   
        $userId = Auth::id();

        $request->validate([
            'stok_id' => 'required|integer|exists:stok_darah,id',
            'jumlah' => 'required|integer|min:1|max:' . $request->input('jumlah')
        ]);

        $cekStok = StokDarah::with('jenisDarah')->where('id', $request->stok_id)->first();

        $order = [
            'pencari_id' => $userId,
            'goldar' => $cekStok->jenisDarah->goldar,
            'rhesus' => 'Positif',
            'jumlah' => $request->jumlah,
            'status' => 'Pending',
            'sumber' => 'Stok',
            'keterangan' => json_encode([
                'kategori' => $cekStok->jenisDarah->kategori,
                'stok_id' => $cekStok->id
            ])
        ];

        // Simpan order ke database (sesuaikan dengan model dan tabel yang sesuai)
        Order::create($order);

        return redirect()->back()->with('success', 'Request stok darah berhasil dikirim.');
    }

    

    
    public function profile()
    {
        $user = Auth::user();
        $profile = $user->profile; // Ambil profil terkait dengan pengguna yang sedang login

        return view('front.profile', compact('user', 'profile'));
    }


}
