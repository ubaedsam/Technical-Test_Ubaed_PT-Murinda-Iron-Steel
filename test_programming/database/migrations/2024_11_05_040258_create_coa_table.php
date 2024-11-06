<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coa', function (Blueprint $table) {
            $table->string('mis_kodeacc')->primary();
            $table->string('mis_ccy');
            $table->string('namaacc');
            $table->string('tipeacc');
            $table->string('levelacc');
            $table->string('parentacc');
            $table->string('groupacc');
            $table->string('controlacc');
            $table->string('depart')->nullable();
            $table->string('gainloss')->nullable();
            $table->timestamps();
            $table->foreign('mis_ccy')->references('mis_ccy')->on('currency')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coa');
    }
}
