<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommerceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commerces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('name');
            $table->date('date')->nullable();
            $table->string('logo')->nullable();
            $table->string('address')->nullable();
            $table->decimal('latitude',8,6)->nullable();
            $table->decimal('longitude',8,6)->nullable();
            $table->string('first_image')->nullable();
            $table->string('second_image')->nullable();
            $table->string('type')->nullable();
            $table->text('description')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('prefix_phone')->nullable();
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
        Schema::dropIfExists('commerces');
    }
}
