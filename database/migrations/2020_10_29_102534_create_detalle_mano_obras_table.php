<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleManoObrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_mano_obras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orden_id');
            $table->string('descripcion', 500);
            $table->decimal('precio', 10, 2);
            $table->date('fecha');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('detalle_mano_obras', function (Blueprint $table) {
            $table->foreign('orden_id')->references('id')->on('ordens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_mano_obras');
    }
}
