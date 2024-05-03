<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokDarah extends Model
{
    use HasFactory;

    protected $table = 'stok_darah';

    protected $fillable = [
        'jenis_id',
        'jumlah',
    ];

    public function jenisDarah()
    {
        return $this->belongsTo(JenisDarah::class, 'jenis_id');
    }
}

