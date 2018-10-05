<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTspicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tspics', function (Blueprint $table) {
            $table->increments('tspicsId');
			$table->string('name');
			$table->string('url');
			$table->string('tag');
			$table->integer('orders');
			$table->integer('designer');
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
        Schema::dropIfExists('tspics');
    }
}
