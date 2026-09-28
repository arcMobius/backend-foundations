<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('name');
            $table->string('preview_image')->default('preview.jpg');
            $table->string('full_image')->default('full.jpeg');
            $table->text('shortDesc')->nullable();
            $table->text('desc');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
