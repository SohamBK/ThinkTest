<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::create('question_option', function (Blueprint $table) {
            // $table->increments('id');
            // $table->integer('question_id');
            // $table->string('option');
            // $table->smallInteger('is_correct')->nullable();
            // $table->timestamps();
            // $table->integer('created_by')->nullable();
            // $table->integer('updated_by')->nullable();

        //});
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
