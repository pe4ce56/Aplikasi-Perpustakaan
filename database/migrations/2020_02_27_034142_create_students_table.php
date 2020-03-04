<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('students')) {
            Schema::create('students', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('user_id');
                $table->bigInteger('NIS')->unique();
                $table->string('name', 100);
                $table->string('gender', 20);
                $table->string('place_of_birth', 100);
                $table->date('date_of_birth');
                $table->string('religion', 30);
                $table->string('phone_number', 15);
                $table->string('address', 200)->nullable();
                $table->string('profile_picture', 200)->nullable();
                $table->unsignedBigInteger('grade_id');
                $table->unsignedBigInteger('department_id');
                $table->foreign('grade_id')->references('id')->on('grades');
                $table->foreign('department_id')->references('id')->on('departments');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
