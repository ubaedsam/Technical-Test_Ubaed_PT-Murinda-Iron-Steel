<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transx', function (Blueprint $table) {
            $table->id();
            $table->string('jrcode');
            $table->string('tanggal_transaksi');
            $table->string('nomor_ref');
            $table->text('remark');
            $table->string('mis_kodeacc');
            $table->text('description');
            $table->string('debet');
            $table->string('kredit');
            $table->timestamps();
            $table->foreign('jrcode')->references('jrcode')->on('jrcode')->onDelete('cascade');
            $table->foreign('mis_kodeacc')->references('mis_kodeacc')->on('coa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transx');
    }
}
