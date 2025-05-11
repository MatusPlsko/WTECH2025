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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('shipping_address2')->nullable();
            $table->string('city');
            $table->string('postal_code');
            $table->string('country');
            $table->string('payment_method');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'first_name', 'last_name', 'email', 'phone',
                'shipping_address', 'shipping_address2',
                'city', 'postal_code', 'country', 'payment_method'
            ]);
        });
    }
};
