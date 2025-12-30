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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->longText('content');
            $table->text('subtitle');
            $table->string('meta_title');
            $table->text('meta_description');
            $table->boolean('published')->default(true);
            $table->boolean('in_menu')->default(true);
            $table->boolean('privacy_policy')->default(false);
            $table->integer('order')->nullable();
            $table->timestamps();
        });
    }
};
