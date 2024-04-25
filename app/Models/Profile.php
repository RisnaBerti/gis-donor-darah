<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'tempatlahir',
        'tanggallahir',
        'jeniskelamin',
        'alamat',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'kodepos',
        'lat',
        'long',
        'golongan_darah',
        'rhesus',
        'pekerjaan',
    ];

    /**
     * Get the user that owns the profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

