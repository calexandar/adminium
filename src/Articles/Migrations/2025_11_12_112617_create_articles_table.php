<?php

declare(strict_types=1);

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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id');
            $table->foreignId('author_id')->constrained('users');
            $table->string('title');
            $table->string('slug');
            $table->longText('content');
            $table->text('short_description');
            $table->string('meta_title');
            $table->text('meta_description');
            $table->boolean('published')->default(true);
            $table->integer('order')->nullable();
            $table->timestamps();
        });
    }
};
