<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function spp()
    {
        return $this->belongsto(SPP::class);
    }

    public function petugas()
    {
        return $this->belongsto(Petugas::class);
    }
}
