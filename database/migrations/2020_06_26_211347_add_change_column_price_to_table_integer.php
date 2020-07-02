<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChangeColumnPriceToTableInteger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('price')->change();
        });

        Schema::table('details', function (Blueprint $table) {
            $table->integer('price')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('price', 12,3);
        });

        Schema::table('details', function (Blueprint $table) {
            $table->integer('price')->change();
        });
    }
}
