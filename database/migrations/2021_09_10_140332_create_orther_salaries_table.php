<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrtherSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orther_salaries', function (Blueprint $table) {
            $table->increments('orther_salary_id');
            $table->integer('employee_id');
            $table->integer('month_orther');
            $table->integer('year_orther');
            $table->string('reason_orther');
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
        Schema::dropIfExists('orther_salaries');
    }
}
