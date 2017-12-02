<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRouteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('requestId');
            $table->unsignedInteger('collectorId');
            $table->datetime('dateTime');
            $table->boolean('isActive')->default(1);
            $table->timestamps();
            $table->foreign('requestId')
                  ->references('id')->on('request_header')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('collectorId')
                  ->references('id')->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('route');
    }
}
