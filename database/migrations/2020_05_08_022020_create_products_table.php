<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commerce_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('station_id')->constrained();
            $table->string('name');
            $table->decimal('price', 10, 2)->default(0.0);
            $table->string('image')->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('use_stock');
            $table->integer('stock')->nullable();
            $table->string('description')->nullable();
            $table->string('margin')->nullable();
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
        Schema::dropIfExists('products');
    }
}
