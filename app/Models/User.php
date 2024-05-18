<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nik',
        'email',
        'mobile',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profileIsComplete()
    {
        return !empty($this->profile->tempatlahir) &&
            !empty($this->profile->tanggallahir) &&
            !empty($this->profile->jeniskelamin) &&
            !empty($this->profile->alamat) &&
            !empty($this->profile->desa) &&
            !empty($this->profile->kecamatan) &&
            !empty($this->profile->kabupaten) &&
            !empty($this->profile->provinsi) &&
            !empty($this->profile->kodepos) &&
            !empty($this->profile->lat) &&
            !empty($this->profile->long) &&
            !empty($this->profile->golongan_darah) &&
            !empty($this->profile->rhesus) &&
            !empty($this->profile->pekerjaan);
    }


    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function riwayat()
    {
        return $this->hasMany(RiwayatDonor::class);
    }
}
