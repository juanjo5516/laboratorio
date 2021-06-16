<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasMaterialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras_materiales', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->decimal('precio', 10, 2);
            $table->foreignId('compra_id')->constrained();
            $table->foreignId('material_id')->constrained('materiales');
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
        Schema::dropIfExists('compras_materiales');
    }
}
