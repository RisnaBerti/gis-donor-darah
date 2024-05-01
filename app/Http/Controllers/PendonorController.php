<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Spatie\Permission\Models\Role;

class PendonorController extends Controller
{
    public function index()
    {
        $pendonors = User::role('pendonor')->with('profile')->get();
        return view('pendonors.index', compact('pendonors'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('pendonors.create', compact('roles'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|integer|unique:users',     
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|exists:roles,id',
            'nama' => 'required|string|max:255',           
        ]);

        // Create user
        $user = User::create([
            'nik' => $request->nik,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Create profile
        $user->profile()->create([
            'nama' => $request->nama,            
        ]);

        // Assign role to user
        $role = 'pendonor';
        $user->assignRole($role);

        return redirect()->route('pendonors.index')->withSuccess('Pendonor berhasil dibuat.');
    }

    public function show(User $user)
    {
        return view('pendonors.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('pendonors.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {   
        $request->validate([
            'nik' => 'required|integer|unique:users,nik,' . $user->id,            
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'nama' => 'required|string|max:255',
            'tempatlahir' => 'nullable|string|max:255',
            'tanggallahir' => 'nullable|date',
            'jeniskelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string|max:255',
            'desa' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'kodepos' => 'nullable|string|max:10',
            'lat' => 'nullable|string|max:255',
            'long' => 'nullable|string|max:255',
            'golongan_darah' => 'nullable|in:A,B,AB,O',
            'rhesus' => 'nullable|in:+,-',
            'pekerjaan' => 'nullable|string|max:255',
        ]);
        
        $userData = [
            'nik' => $request->nik,           
            'email' => $request->email,
        ];

        // Update user data
        if ($request->filled('password')) {
            $userData['password'] = bcrypt($request->password);
        }

             
        $user->update($userData);

        // Update profile data
        $user->profile()->update([
            'nama' => $request->nama,
            'tempatlahir' => $request->tempatlahir,
            'tanggallahir' => $request->tanggallahir,
            'jeniskelamin' => $request->jeniskelamin,
            'alamat' => $request->alamat,
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
            'provinsi' => $request->provinsi,
            'kodepos' => $request->kodepos,
            'lat' => $request->lat,
            'long' => $request->long,
            'golongan_darah' => $request->golongan_darah,
            'rhesus' => $request->rhesus,
            'pekerjaan' => $request->pekerjaan,
        ]);

    
        return redirect()->route('pendonors.index')->withSuccess('User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('pendonors.index')->withSuccess('User deleted successfully.');
    }
}
