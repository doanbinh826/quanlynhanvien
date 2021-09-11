<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaraliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saralies', function (Blueprint $table) {
            $table->increments('saraly_id');
            $table->integer('employee_id');
            $table->string('employee_name');
            $table->date('start_work_day');
            $table->integer('hard_saraly');
            $table->integer('day_works');
            $table->integer('hard_total_saraly');
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
        Schema::dropIfExists('saralies');
    }
}
