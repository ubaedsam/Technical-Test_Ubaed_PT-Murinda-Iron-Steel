<?php

namespace App\Models\COA;

use App\Models\CYY\cyy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coa extends Model
{
    use HasFactory;

    protected $table = "coa"; // menghubungkan ke dalam tabel coa

    protected $guarded = [];

    public $primaryKey = 'mis_kodeacc';
    public $keyType = 'string';
    public $autoIncrement = 'false';

    public function currency()
    {
        return $this->belongsTo(cyy::class, 'mis_ccy');
    }
}
