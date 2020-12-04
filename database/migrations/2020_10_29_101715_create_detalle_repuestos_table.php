<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleRepuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_repuestos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orden_id');
            $table->unsignedBigInteger('repuesto_id');
            $table->decimal('precio', 8, 2);
            $table->date('fecha');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('detalle_repuestos', function (Blueprint $table) {
            $table->foreign('orden_id')->references('id')->on('ordens');
            $table->foreign('repuesto_id')->references('id')->on('repuestos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_repuestos');
    }
}
