<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\StokDarah;
use App\Models\JenisDarah;
use App\Models\Order;

use App\Helpers\Dijkstra;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
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

    public function index()
    {
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::id();

        // Mengambil data order dengan pencari_id yang sesuai dengan ID pengguna yang sedang login
        $history = Order::where('pencari_id', $userId)->get();

        return view('front.search', compact('history'));
    }

    public function search(Request $request)
    {   
        $userId = Auth::id();

        $pencari = User::where('id', $userId)->with('profile')->first();

        $goldar = $request->input('goldar');
        $jumlah = $request->input('jumlah');

        // Lakukan pencarian pendonor berdasarkan golongan darah
        $donors = User::role('pendonor')->with('profile')
                ->whereHas('profile', function ($query) use ($goldar) {
                    $query->where('golongan_darah', $goldar);
                })
                ->get();

       // Inisialisasi graf untuk algoritma Dijkstra
        $graph = [];
        $graph['Pencari'] = [];

        // Hitung jarak antara pencari dan setiap pendonor
        foreach ($donors as $donor) {
            $distance = $this->calculateDistance($pencari->profile->lat, $pencari->profile->long, $donor->profile->lat, $donor->profile->long);
            $graph['Pencari'][$donor->id] = $distance;
            
            // Jika ingin menambahkan informasi jarak dari pendonor ke pencari
            $graph[$donor->id]['Pencari'] = $distance;
        }
       
        // Gunakan algoritma Dijkstra
        $distances = $this->dijkstra($graph, 'Pencari');
        
        // Ambil array kunci (id) pendonor yang sudah diurutkan berdasarkan jarak terpendek
        $sortedDonorIds = array_keys($distances);

        // Filter hanya pendonor yang memiliki jarak terhitung dan id-nya tersedia dan tidak null
        $sortedDonors = User::whereIn('id', $sortedDonorIds)->with('profile')->get()->filter(function ($donor) use ($distances) {
            return isset($distances[$donor->id]) && $donor->id; // Kondisi tambahan untuk memastikan id tidak null
        })->map(function ($donor) use ($distances) {
            // Tambahkan nilai jarak ke profil pendonor
            $donor->distance = $distances[$donor->id];
            return $donor;
        })->sortBy('distance');

        // Hasil akhir: $sortedDonors berisi profil pendonor yang sudah diurutkan berdasarkan jarak terpendek beserta nilai jaraknya
        return $this->searchResult($sortedDonors);

    }

    
    private function dijkstra($graph, $source) {
        // Ambil semua titik dalam graf
        $vertices = array_keys($graph);
    
        // Inisialisasi array jarak dengan nilai infinity
        $distances = array_fill_keys($vertices, INF);
    
        // Jarak dari titik awal ke dirinya sendiri adalah 0
        $distances[$source] = 0;
    
        // Array untuk melacak titik-titik yang sudah dikunjungi
        $visited = array();
    
        // Loop akan berjalan selama masih ada titik yang belum dikunjungi
        while (!empty($vertices)) {
            // Inisialisasi titik dengan jarak terpendek saat ini
            $minVertex = null;
    
            // Loop untuk mencari titik dengan jarak terpendek
            foreach ($vertices as $vertex) {
                // Periksa apakah titik belum diinisialisasi atau memiliki jarak terpendek
                if ($minVertex === null || $distances[$vertex] < $distances[$minVertex]) {
                    // Jika ya, tetapkan titik saat ini sebagai titik dengan jarak terpendek
                    $minVertex = $vertex;
                }
            }
    
            // Jika tidak ada lagi titik yang terhubung, keluar dari loop
            if ($distances[$minVertex] === INF) {
                break;
            }
    
            // Hapus titik dengan jarak terpendek dari array vertices
            $vertices = array_diff($vertices, array($minVertex));
    
            // Tambahkan titik dengan jarak terpendek ke dalam array visited
            $visited[] = $minVertex;
    
            // Loop untuk mengecek tetangga dari titik dengan jarak terpendek
            foreach ($graph[$minVertex] as $neighbor => $weight) {
                // Periksa apakah tetangga sudah tercatat dalam array distances
                if (isset($distances[$neighbor])) {
                    // Hitung alternatif jarak melalui titik terpendek saat ini
                    $alt = $distances[$minVertex] + $weight;
    
                    // Jika alternatif jarak lebih kecil, perbarui jarak dalam array distances
                    if ($alt < $distances[$neighbor]) {
                        $distances[$neighbor] = $alt;
                    }
                }
            }
        }
    
        // Urutkan array distances berdasarkan nilai jarak terpendek
        asort($distances);
    
        // Kembalikan array distances yang berisi jarak terpendek dari titik awal ke setiap titik dalam graf
        return $distances;
    }
    
    
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        // Haversine formula untuk menghitung jarak antara dua titik dengan koordinat
        $earthRadius = 6371; // Radius bumi dalam kilometer
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c; // Jarak dalam kilometer
    
        return $distance;
    }


    
    public function searchResult($donors)
    {   
        // Tampilkan halaman hasil pencarian dengan data donor yang sudah diurutkan
        return view('front.order', compact('donors'));
    }
    


}
