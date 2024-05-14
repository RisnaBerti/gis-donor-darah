<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'requests';

    protected $fillable = [
        'pencari_id',
        'goldar',
        'rhesus',
        'jumlah',
        'status',
        'sumber',
        'pendonor_id',
        'keterangan',
    ];

    public function pencari()
    {
        return $this->belongsTo(User::class, 'pencari_id', 'id');
    }

    public function pendonor()
    {
        return $this->belongsTo(User::class, 'pendonor_id', 'id');
    }
}
