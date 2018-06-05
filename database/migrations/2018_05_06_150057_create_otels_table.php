<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('isim');
            $table->integer('sehir_id')->unsigned()->index();
            $table->text('adres');
            $table->char('phone',17);
            $table->char('kisaaciklama',144);
            $table->text('uzunaciklama');
            $table->timestamps();
            $table->foreign('sehir_id')->references('id')->on('sehirs')->onDelete('cascade');
            $table->string("markerAddress");
            $table->string("position");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('otels');
    }
}
