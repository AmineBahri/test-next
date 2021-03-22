<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('cin');
            $table->string('address');
            $table->date('birthday');
            $table->integer('phone');
            $table->string('image_path');
            $table->string('parents_name');
            $table->bigInteger('customertype_id')->unsigned();
            $table->foreign('customertype_id')->references('id')->on('customers_type')->onDelete('cascade');
            $table->bigInteger('companie_id')->unsigned();
            $table->foreign('companie_id')->references('id')->on('companies')->onDelete('cascade');
            $table->bigInteger('municipalite_id')->unsigned();
            $table->foreign('municipalite_id')->references('id')->on('municipalites')->onDelete('cascade');
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
        Schema::dropIfExists('customers');
    }
}
