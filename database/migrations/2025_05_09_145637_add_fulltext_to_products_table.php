<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // vytvor Full-Text index na name a description
            $table->fullText(['name', 'description']);
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropFullText(['name', 'description']);
        });
    }
};
