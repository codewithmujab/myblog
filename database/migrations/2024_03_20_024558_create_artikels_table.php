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
        Schema::create('artikels', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('kategori_id'); //singgle select
            $table->string('tag_id'); //multiple select
            $table->string('judul')->unique();
            $table->string('tumbnail')->nullable();
            $table->string('slug')->unique();
            $table->text('isi');
            $table->string('publish', 1)->nullable()->default('N'); //Y or N
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikels');
    }
};
