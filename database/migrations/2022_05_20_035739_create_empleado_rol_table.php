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
        Schema::create('empleado_rol', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empleado_id')->length(10);
            $table->unsignedBigInteger('rol_id')->length(11);;
            $table->foreign('empleado_id')->references('id')->on('empleado')->onDelete('cascade');
            $table->foreign('rol_id')->references('id')->on('roles')->onDelete('cascade');
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
        Schema::dropIfExists('empleado_rol');
    }
};
