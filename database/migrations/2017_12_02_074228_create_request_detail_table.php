<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_detail', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('requestId');
            $table->unsignedInteger('itemId');
            $table->string('photo')->nullable();
            $table->string('description',140)->nullable();
            $table->foreign('requestId')
                  ->references('id')->on('request_header')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('itemId')
                  ->references('id')->on('item')
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
        Schema::dropIfExists('request_detail');
    }
}
