<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUpdatedAtToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Pridaj stĺpec updated_at
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Odstráň stĺpec updated_at, ak budeš rollbackovať migráciu
            $table->dropColumn('updated_at');
        });
    }
}
