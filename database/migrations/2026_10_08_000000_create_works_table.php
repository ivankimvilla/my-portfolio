<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('short_description', 500);
            $table->text('full_description');
            $table->string('category')->nullable();
            $table->string('project_url', 2048)->nullable();
            $table->binary('image_blob');
            $table->string('image_mime_type', 64);
            $table->string('status', 16)->default('draft');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['status', 'sort_order']);
        });

        if (in_array(DB::connection()->getDriverName(), ['mysql', 'mariadb'], true)) {
            DB::statement('ALTER TABLE works MODIFY image_blob LONGBLOB NOT NULL');
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
