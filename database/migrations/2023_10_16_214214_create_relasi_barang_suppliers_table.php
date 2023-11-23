<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelasiBarangSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relasi_barang_suppliers', function (Blueprint $table) {
            $table->string('FKD_RLS');
            $table->string('FK_SUP');
            $table->string('FK_BRG');
            $table->string('FN_BRG_SUP');
            $table->string('FHARGA_AKHIR');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relasi_barang_suppliers');
    }
}
