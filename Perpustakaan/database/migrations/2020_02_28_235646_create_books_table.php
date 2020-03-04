<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('books')) {

            Schema::create('books', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('code', 20);
                $table->string('title', 50);
                $table->string('publisher', 100);
                $table->string('author', 50);
                $table->string('image', 200);
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
        Schema::dropIfExists('books');
    }
}
