<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['laporan_id', 'pengirim', 'pesan'];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }
}