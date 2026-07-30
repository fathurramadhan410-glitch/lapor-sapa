<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class laporan extends Model
{
      protected $fillable = [
    'nama_pelapor', 'no_hp', 'judul_laporan', 'lokasi', 'latitude', 'longitude', 'ip_address', 'deskripsi', 'foto', 'status', 'kode_tiket',
];
  public function chats()
 {
     return $this->hasMany(Chat::class);
 }
}

