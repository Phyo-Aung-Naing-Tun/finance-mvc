<?php

use Root\App\Services\Migration\Blueprint;
use Root\App\Services\Migration\Schema;
use Root\App\Services\Migration\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->int("wallet_id");
            $table->int("category_id");
            $table->string("type");
            $table->int("amount");
            $table->string("description");
            $table->timestamps("transaction_date");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
