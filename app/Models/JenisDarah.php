<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisDarah extends Model
{
    use HasFactory;

    protected $table = 'jenis_darah';

    protected $fillable = [
        'goldar',
        'rhesus',
        'kategori',
        'masa_kadaluarsa',
        'suhu_simpan',
        'keterangan',
    ];
    

    public function stokDarah()
    {
        return $this->hasMany(StokDarah::class, 'jenis_id');
    }
}
