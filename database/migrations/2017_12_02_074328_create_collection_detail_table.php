<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectionDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_detail', function (Blueprint $table) {
            $table->unsignedInteger('collectionId');
            $table->unsignedInteger('itemId');
            $table->integer('quantity');
            $table->timestamps();
            $table->foreign('collectionId')
                  ->references('id')->on('collection_header')
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
        Schema::dropIfExists('collection_detail');
    }
}
