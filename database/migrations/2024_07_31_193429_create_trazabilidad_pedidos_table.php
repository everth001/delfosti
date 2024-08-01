<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trazabilidad_pedidos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pedido');
            $table->string('producto');
            $table->string('tipo_fecha');
            $table->dateTime('fecha');
            $table->integer('user_id');
            $table->string('nombre_user');
            $table->string('repartidor')->nullable();
            $table->string('estado');
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
        Schema::dropIfExists('trazabilidad_pedidos');
    }
};
