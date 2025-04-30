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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->int("user_id");
            $table->string("name");
            $table->string("type");
            $table->int("balance")->default(0);
            $table->string("currency");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
