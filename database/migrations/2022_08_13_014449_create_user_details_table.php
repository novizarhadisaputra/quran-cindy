<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->string('id');
            $table->string('phone')->nullable();
            $table->enum('status', ['married', 'single', 'divorcee'])->nullable();
            $table->text('address')->nullable();
            $table->dateTime('born_date')->nullable();
            $table->string('job')->nullable();
            $table->boolean('sex')->nullable();
            $table->string('user_id');
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
        Schema::dropIfExists('user_details');
    }
}
