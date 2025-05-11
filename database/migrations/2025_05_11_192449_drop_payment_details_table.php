<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('payment_details');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('payment_details', function ($table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->string('payment_method');
            $table->string('transaction_id');
            $table->decimal('amount', 8, 2);
            $table->string('status');
            $table->timestamp('created_at')->useCurrent();
        });
    }
};
