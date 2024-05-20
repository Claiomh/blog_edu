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
        // Удаляем таблицу, если она уже существует
        Schema::dropIfExists('posts');

        // Создаем таблицу заново
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();

            $table->string('title');
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('likes')->default(0);
            $table->boolean('is_published')->default(true);
            $table->string('slug')->unique();
            $table->timestamps();

            $table->softDeletes();

            $table->index('category_id', 'posts_category_idx');
            $table->foreign('category_id', 'post_category_fk')
                ->references('id')->on('categories')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
