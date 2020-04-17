<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string("title")->required();
            $table->text("description")->nullable();
            $table->unsignedTinyInteger("n_rooms")->required();
            $table->unsignedTinyInteger("n_baths")->required();
            $table->unsignedSmallInteger("sq_meters")->required();
            $table->string("address")->required();
            $table->decimal("latitude", 10, 7);
            $table->decimal("longitude", 10, 7);
            $table->float("price", 6, 2)->required();
            $table->string("cover_img")->nullable();
            $table->boolean("active")->default(1);
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
        Schema::dropIfExists('apartments');
    }
}
