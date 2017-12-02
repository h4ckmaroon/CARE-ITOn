<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_rate', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('itemId');
            $table->double('rate',15,2);
            $table->timestamps();
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
        Schema::dropIfExists('item_rate');
    }
}
