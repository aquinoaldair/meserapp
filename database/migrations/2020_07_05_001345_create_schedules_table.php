<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commerce_id')->constrained();
            $table->string('monday', 50)->nullable();
            $table->string('tuesday', 50)->nullable();
            $table->string('wednesday', 50)->nullable();
            $table->string('thursday', 50)->nullable();
            $table->string('friday', 50)->nullable();
            $table->string('saturday', 50)->nullable();
            $table->string('sunday', 50)->nullable();
            $table->boolean('is_starting')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
