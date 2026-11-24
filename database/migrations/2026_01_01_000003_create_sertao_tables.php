<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lore_archives', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('icon')->default('file-text');
            $table->string('title');
            $table->text('summary');
            $table->text('fragment');
            $table->boolean('offset')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('screenshots', function (Blueprint $table) {
            $table->id();
            $table->string('src')->nullable();
            $table->string('caption');
            $table->string('hue')->default('amber');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role');
            $table->string('note')->nullable();
            $table->string('icon')->default('user');
            $table->string('photo')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('download_logs', function (Blueprint $table) {
            $table->id();
            $table->string('platform', 32);
            $table->string('version', 64)->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('download_logs');
        Schema::dropIfExists('team_members');
        Schema::dropIfExists('screenshots');
        Schema::dropIfExists('lore_archives');
    }
};
