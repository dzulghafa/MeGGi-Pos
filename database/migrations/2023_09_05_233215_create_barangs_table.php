<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->string('FK_BRG')->primary();
            $table->string('FN_BRG');
            $table->string('FK_JENIS');
            $table->string('FK_SAT');
            $table->double('FHARGA_HNA')->default(0);
            $table->double('FHARGA_JUAL')->default(0);
            $table->double('FPROFIT')->default(0);
            $table->double('FSALDO')->default(0);
            $table->double('FIN')->default(0);
            $table->double('FOUT')->default(0);
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
        Schema::dropIfExists('barangs');
    }
}
