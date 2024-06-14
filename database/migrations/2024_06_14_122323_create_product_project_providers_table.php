<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_project_providers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id');
            $table->foreignId('project_space_id')->nullable();
            $table->foreignId('provider_id');
            $table->unsignedBigInteger('product_id');
            $table->string('product_type');
            $table->boolean('has_materiales');
            $table->boolean('has_transporte');
            $table->boolean('has_suministro');
            $table->boolean('has_instalacion');
            $table->decimal('quantity')->nullable();
            $table->decimal('price_per_unit')->nullable();
            $table->decimal('total')->nullable();
            $table->decimal('valid_until')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_project_providers');
    }
};
