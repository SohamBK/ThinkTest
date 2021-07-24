<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('departments', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('department_name');
        //     $table->smallInteger('status')->nullable();
        //     $table->timestamps();
        //     $table->integer('created_by')->nullable();
        //     $table->integer('updated_by')->nullable();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
