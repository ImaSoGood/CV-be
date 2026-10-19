<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('owner', function (Blueprint $table) 
        {
            $table->string('about', 512)->nullable();
            $table->json('achivements')->nullable();
            $table->string('picture_url')->nullable();
        });
    }

    public function down(): void
    {
        
    }
};
