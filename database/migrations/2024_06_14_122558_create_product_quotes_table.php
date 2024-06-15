<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_quotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id');
            $table->foreignId('quote_id');

            $table->foreignId('product_project_provider_id');

            $table->foreignId('product_category_id');
            $table->decimal('total', 20)->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_quotes');
    }
};
