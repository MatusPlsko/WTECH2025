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
        // vytvor index na kombinovaný tsvector
        DB::statement("
            CREATE INDEX products_fulltext_idx
            ON products
            USING GIN (
              to_tsvector('english', coalesce(name,'') || ' ' || coalesce(description,''))
            )
        ");
    }

    public function down()
    {
        DB::statement("DROP INDEX IF EXISTS products_fulltext_idx");
    }
};
