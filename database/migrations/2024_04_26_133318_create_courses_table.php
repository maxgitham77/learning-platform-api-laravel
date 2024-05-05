<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\CourseLevel;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('hashid')->nullable();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subcategory_id')->constrained('categories', 'id')->cascadeOnDelete();
            $table->string('title');
            $table->string('subtitle');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->enum('level', ['all', 'beginner', 'intermediate', 'advanced']);
            //$table->enum('level')->default((CourseLevel::ALL)->value);
            $table->decimal('price', 8,2)->default(0);
            $table->dateTime('published_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
