<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMecanicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mecanicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->unique();
            $table->string('nombre_completo', 50);
            $table->string('ci', 20);
            $table->string('telefono', 50);
            $table->string('direccion', 300)->nullable();
            $table->string('email', 50)->nullable()->unique();
            $table->string('especialidad', 50)->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->date('fecha_salida')->nullable();
            $table->string('src_foto', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('mecanicos', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mecanicos');
    }
}
