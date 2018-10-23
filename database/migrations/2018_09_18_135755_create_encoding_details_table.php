<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncodingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encoding_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('encoding_id');
            $table->foreign('encoding_id')->references('id')->on('encodings');
            $table->string('source_url', 2083);
            $table->tinyInteger('encoding_qty');
            $table->unsignedInteger('duration')->nullable();
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
        Schema::dropIfExists('encoding_details');
    }
}
