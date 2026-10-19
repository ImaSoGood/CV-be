<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) 
        {
            $table->id();
            $table->string('name')->nullable();
            $table->string('text')->nullable();
            $table->string('picture_url')->nullable();
            $table->json('settings')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
