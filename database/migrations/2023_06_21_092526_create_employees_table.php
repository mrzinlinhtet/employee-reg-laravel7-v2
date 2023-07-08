<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /**
     * Class CreateEmployeesTable
     * Create employee table for databese.
     *
     * @author Zin Lin Htet
     * @created 21/6/2023
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('employee_id')->unique();
            $table->string('employee_code',50);
            $table->string('employee_name',50);
            $table->string('nrc_number',50);
            $table->string('password',255);
            $table->string('email_address',255)->unique();
            $table->integer('gender')->nullable();
            $table->date('date_of_birth');
            $table->integer('marital_status')->nullable();
            $table->longText('address')->nullable();
            $table->string('otp')->nullable();
            $table->softDeletes('deleted_at');
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
        Schema::dropIfExists('employees');
    }
}
