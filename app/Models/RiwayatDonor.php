<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatDonor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal_donor',
        'berat_badan',
        'keterangan',
        'donor_ke',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
