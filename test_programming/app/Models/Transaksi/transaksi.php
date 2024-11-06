<?php

namespace App\Models\Transaksi;

use App\Models\COA\coa;
use App\Models\JURNAL\jurnal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;

    protected $table = "transx"; // menghubungkan ke dalam tabel transx

    protected $guarded = [];

    public function coa()
    {
        return $this->belongsTo(coa::class, 'mis_kodeacc');
    }

    public function jurnal()
    {
        return $this->belongsTo(jurnal::class, 'jrcode');
    }
}
