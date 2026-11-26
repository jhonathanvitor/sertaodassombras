<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        Schema::create('sponsors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo', 2048)->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::table('screenshots', function (Blueprint $table) {
            $table->string('src', 2048)->nullable()->change();
        });

        Schema::table('team_members', function (Blueprint $table) {
            $table->string('photo', 2048)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sponsors');
        Schema::dropIfExists('site_settings');
    }
};
