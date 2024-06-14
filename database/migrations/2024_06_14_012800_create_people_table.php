<?php

use App\Models\Person;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('identification_type')->default(Person::IDENTIFICATION_TYPE_CEDULA);
            $table->string('identification_number')->unique();
            $table->string('name')->index();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->boolean('is_provider')->default(false);
            $table->boolean('is_client')->default(false);
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
