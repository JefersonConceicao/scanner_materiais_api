<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFuncionalidadeRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionalidade_role', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('funcionalidade_id');
            $table->unsignedInteger('role_id');

            $table->foreign('funcionalidade_id')->references('id')->on('funcionalidades');
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcionalidade_role');
    }
}
