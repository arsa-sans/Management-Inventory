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
        Schema::create('card_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaction')->nullable();
            $table->enum('type_transaction', ['in', 'out', 'adjustment', 'retur'])->nullable();
            $table->string('no_sku');
            $table->integer('total_in')->nullable();
            $table->integer('total_out')->nullable();
            $table->integer('last_stock');
            $table->string('officer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_stocks');
    }
};
