<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $profile = $user->profile; // Ambil profil terkait dengan pengguna yang sedang login

        return view('users.profile', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tempatlahir' => 'nullable|string|max:255',
            'tanggallahir' => 'nullable|date',
            'jeniskelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string|max:255',
            'desa' => 'nullable|string|max:255', // Tambahkan validasi untuk desa dan kolom lainnya
            'kecamatan' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'kodepos' => 'nullable|string|max:10',
            'lat' => 'nullable|string|max:20',
            'long' => 'nullable|string|max:20',
            'golongan_darah' => 'nullable|in:A,B,AB,O',
            'rhesus' => 'nullable|in:+,-',
            'pekerjaan' => 'nullable|string|max:255',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|max:12|required_with:current_password',
            'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password'
        ]);
    
        $user = Auth::user();
        $profile = $user->profile; // Ambil profil terkait dengan pengguna yang sedang login
    
        // Pastikan $profile tidak null sebelum memanggil fill()
        if (!$profile) {
            $profile = new Profile(); // Buat objek baru jika tidak ada profil sebelumnya
            $profile->user_id = $user->id; // Set user_id sesuai dengan pengguna yang sedang login
        }
    
        $profile->fill($request->only([
            'nama', 'tempatlahir', 'tanggallahir', 'jeniskelamin',
            'alamat', 'desa', 'kecamatan', 'kabupaten', 'provinsi', 'kodepos',
            'lat', 'long', 'golongan_darah', 'rhesus', 'pekerjaan'
        ]));
    
        // Update password jika diinput dan valid
        if (!is_null($request->input('current_password'))) {
            if (Hash::check($request->input('current_password'), $user->password)) {
                $user->password = Hash::make($request->input('new_password'));
            } else {
                return redirect()->back()->withInput()->withErrors(['current_password' => 'The current password is incorrect.']);
            }
        }
    
        $user->save();
        $profile->save();
    
        return redirect()->route('profile')->withSuccess('Profile updated successfully.');
    }
    
}
