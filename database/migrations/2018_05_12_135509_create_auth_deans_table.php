<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthDeansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_deans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',200);
            $table->string('auth',200)->nullable();
            $table->string('testtime',50)->nullable();
            $table->integer('questcount')->nullable();
            $table->boolean('active')->nullable();
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
        Schema::dropIfExists('auth_deans');
    }
}
