<?php

namespace App\Models\CYY;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cyy extends Model
{
    protected $table = "currency"; // menghubungkan ke dalam tabel currency

    protected $guarded = [];

    public $primaryKey = 'mis_ccy';
    public $keyType = 'string';
    public $autoIncrement = 'false';
}
