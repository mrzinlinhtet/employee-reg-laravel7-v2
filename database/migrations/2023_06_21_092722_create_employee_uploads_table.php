<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
        /**
     * Class CreateEmployeeUploadsTable
     * Create employee upload table for databese.
     *
     * @author Zin Lin Htet
     * @created 21/6/2023
     */
    public function up()
    {
        Schema::create('employee_uploads', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('employee_id');
            $table->foreign('employee_id')->references('employee_id')
                    ->on('employees')
                    ->onDelete('cascade');
            $table->string('file_path',500);
            $table->integer('file_size');
            $table->string('file_extension',50);
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
        Schema::dropIfExists('employee_uploads');
    }
}
