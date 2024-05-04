<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;

class HomeController extends Controller
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
        $pendonors = User::role('pendonor')->count();
        $pencaris = User::role('pencaridonor')->count();

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

        
        
        $widget = [
            'pendonor' => $pendonors,
            'pencari' => $pencaris,
        ];

        return view('dashboard', compact('widget', 'markPendonor'));
    }
}
