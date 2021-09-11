<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onsites', function (Blueprint $table) {
            $table->increments('onsite_id');
            $table->integer('employee_id');
            $table->integer('date_onsite');
            $table->integer('month_onsite');
            $table->integer('year_onsite');
            $table->string('address_onsite');
            $table->integer('money_onsite');
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
        Schema::dropIfExists('onsites');
    }
}
