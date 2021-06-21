<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 6);
            $table->string('nombre');
            $table->string('descripcion');
            $table->integer('stock_minimo_viable');
            $table->integer('existencia');
            $table->decimal('precio', 10, 2);
            $table->string('foto')->nullable();
            $table->foreignId('unidad_id')->constrained('unidades');
            $table->foreignId('categoria_id')->constrained();
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
        Schema::dropIfExists('productos');
    }
}
