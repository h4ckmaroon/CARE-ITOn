<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_detail', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('userId');
            $table->string('firstName',50);
            $table->string('middleName',50)->nullable();
            $table->string('lastName',50);
            $table->string('contactNo',50);
            $table->string('email')->unique();
            $table->string('photo')->nullable();
            $table->foreign('userId')
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
        Schema::dropIfExists('user_detail');
    }
}
