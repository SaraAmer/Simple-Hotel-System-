<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('room_number')->start_from(1000);
            // $table->integer('floor_id');
             $table->unsignedInteger('floor_id');///foriegn key to the floorstable

             $table->foreign('floor_id')->nullable()

             ->references('number')->on('floors')

             ->onDelete('cascade');
            //  $table->string('status');
            $table->integer('capacity');
            $table->float('price_inCents', 8, 3);

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
        Schema::dropIfExists('rooms');
    }
}
