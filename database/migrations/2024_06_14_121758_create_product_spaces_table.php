<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_spaces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id');
            $table->foreignId('project_space_id');
            $table->foreignId('product_id')->nullable();
            $table->string('name');
            $table->text('description');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_spaces');
    }
};
