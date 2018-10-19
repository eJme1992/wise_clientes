<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id');           
            $table->integer('hosting_id');
            $table->integer('db_id');
            $table->string('tipo');
            $table->string('url');
            $table->string('url_admin');
            $table->string('user');
            $table->string('pass');
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('hosting_id')->references('id')->on('hostings');
            $table->foreign('db_id')->references('id')->on('dbs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webs');
    }
}
