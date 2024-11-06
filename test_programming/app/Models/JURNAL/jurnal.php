<?php

namespace App\Models\JURNAL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jurnal extends Model
{
    protected $table = "jrcode"; // menghubungkan ke dalam tabel jrcode

    protected $guarded = [];

    public $primaryKey = 'jrcode';
    public $keyType = 'string';
    public $autoIncrement = 'false';
}
