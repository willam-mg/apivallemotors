<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_vehiculos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orden_id')->nullable();
            $table->string('accesorio_id', 300);
            $table->date('fecha');
            $table->timestamps();
            $table->softDeletes();
            // $table->unsignedInteger('orden_id');
        });

        Schema::table('estado_vehiculos', function (Blueprint $table) {
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
        Schema::dropIfExists('estado_vehiculos');
    }
}
