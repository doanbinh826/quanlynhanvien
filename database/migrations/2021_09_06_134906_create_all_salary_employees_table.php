<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllSalaryEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_salary_employees', function (Blueprint $table) {
            $table->increments('all_salary_employee_id');
            $table->integer('employee_id');
            $table->string('employee_name');
            $table->string('email');
            $table->string('address');
            $table->string('phone_number');
            $table->string('position');
            $table->integer('total');
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
        Schema::dropIfExists('all_salary_employees');
    }
}
