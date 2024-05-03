<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StokDarah;
use App\Models\JenisDarah;

class StokDarahController extends Controller
{
    public function index()
    {
        $stoks = StokDarah::with('jenisDarah')->get();

        return view('stokdarah.index', compact('stoks'));
    }

    public function create()
    {
        $jeniss = JenisDarah::all();
        return view('stokdarah.create', compact('jeniss'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'golongan_darah' => 'required|in:A,B,AB,O',
            'rhesus' => 'required|in:+,-',
            'kategori' => 'required|string|max:255',
            'masa_kadaluarsa' => 'required|string|max:255',
            'suhu_simpan' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'keterangan' => 'nullable|string|max:255',
        ]);
    
        // Create JenisDarah
        $jenisDarah = JenisDarah::create([
            'goldar' => $request->golongan_darah,
            'rhesus' => $request->rhesus,
            'kategori' => $request->kategori,
            'masa_kadaluarsa' => $request->masa_kadaluarsa,
            'suhu_simpan' => $request->suhu_simpan,
            'keterangan' => $request->keterangan,
        ]);
    
        // Create StokDarah
        $stokDarah = new StokDarah();
        $stokDarah->jenis_id = $jenisDarah->id;
        $stokDarah->jumlah = $request->jumlah;
            
        $stokDarah->save();
    
        return redirect()->route('stokdarahs.index')->withSuccess('Data Jenis Darah dan Stok Darah berhasil ditambahkan.');
    }
    

    public function show(StokDarah $stokdarah)
    {
        return view('stokdarah.show', compact('stokdarah'));
    }

    public function edit(StokDarah $stokdarah)
    {
        return view('stokdarah.edit', compact('stokdarah'));
    }

    public function update(Request $request, StokDarah $stokdarah)
    {
        $request->validate([
            'golongan_darah' => 'required|in:A,B,AB,O',
            'rhesus' => 'required|in:+,-',
            'kategori' => 'required|string|max:255',
            'masa_kadaluarsa' => 'required|string|max:255',
            'suhu_simpan' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'keterangan' => 'nullable|string|max:255',
        ]);

        // Update JenisDarah
        $stokdarah->jenisDarah->update([
            'goldar' => $request->golongan_darah,
            'rhesus' => $request->rhesus,
            'kategori' => $request->kategori,
            'masa_kadaluarsa' => $request->masa_kadaluarsa,
            'suhu_simpan' => $request->suhu_simpan,
            'keterangan' => $request->keterangan,
        ]);

        // Update StokDarah
        $stokdarah->update([
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('stokdarah.index')->withSuccess('Data Jenis Darah dan Stok Darah berhasil diupdate.');
    }

    public function updateStok(Request $request, StokDarah $stokdarah)
    {
        $request->validate([            
            'jumlah' => 'required|integer|min:0',          
        ]);

         // Update StokDarah
         $stokdarah->update([
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('stokdarah.index')->withSuccess('Jumlah Stok Darah berhasil diubah.');
    }


    public function destroy(StokDarah $stokdarah)
    {
        $stokdarah->delete();
        return redirect()->route('stokdarah.index')->withSuccess('Stok Darah berhasil dihapus.');
    }
}
