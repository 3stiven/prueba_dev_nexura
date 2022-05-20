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
        Schema::create('empleado', function (Blueprint $table) {
            $table->id()->start_from(5);
            $table->string('nombre',255)->nullable(false);
            $table->string('email',255)->nullable(false);
            $table->char('sexo',1)->nullable(false);
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('boletin')->length(11)->unsigned();
            $table->text('descripcion')->nullable(false);
            $table->text('estado')->default('activo');
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
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
        Schema::dropIfExists('empleado');
        
    }
};
