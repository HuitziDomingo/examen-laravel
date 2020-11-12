<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresarios', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->text('razon_social');
            $table->string('nombre');
            $table->string('pais');
            $table->string('tipo_moneda');
            $table->string('estado');
            $table->string('ciudad');
            $table->string('telefono');
            $table->string('email')->unique();
            $table->integer('activo');
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
        Schema::dropIfExists('empresarios');
    }
}
