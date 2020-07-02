<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStatusTableTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tables', function (Blueprint $table) {
            $table->enum('status', ['enabled', 'disabled','occupied','reserved', 'ordered'])->default('enabled');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tables', function (Blueprint $table) {
            //
        });
    }
}
