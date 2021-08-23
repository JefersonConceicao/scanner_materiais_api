<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuncionalidadePermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionalidade_permission', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('funcionalidade_id');
            $table->unsignedInteger('permission_id');
            $table->timestamps();

            $table->foreign('funcionalidade_id')->references('id')->on('funcionalidades');            
            $table->foreign('permission_id')->references('id')->on('permissions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcionalidade_permission');
    }
}
