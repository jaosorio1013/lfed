<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id');
            $table->string('identification')->index();
            $table->decimal('subtotal', 20)->nullable();
            $table->decimal('discount', 20)->nullable();
            $table->decimal('percentage_utilidad')->nullable();
            $table->decimal('percentage_administracion')->nullable();
            $table->decimal('percentage_inprevistos')->nullable();
            $table->decimal('percentage_retefuente')->nullable();
            $table->dateTime('valid_until');
            $table->dateTime('sent_at')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->dateTime('rejected_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
