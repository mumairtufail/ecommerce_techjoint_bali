<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('payment_intent_id')->nullable()->after('validated_at');
            $table->string('payment_status')->default('pending')->after('payment_intent_id');
            $table->decimal('payment_amount', 10, 2)->nullable()->after('payment_status');
            $table->string('payment_method')->nullable()->after('payment_amount');
            $table->timestamp('payment_processed_at')->nullable()->after('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn([
                'payment_intent_id',
                'payment_status', 
                'payment_amount',
                'payment_method',
                'payment_processed_at'
            ]);
        });
    }
};
