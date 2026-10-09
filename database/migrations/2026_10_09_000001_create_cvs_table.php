<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cvs', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->string('mime_type', 64);
            $table->binary('file_blob');
            $table->timestamps();
        });

        if (in_array(DB::connection()->getDriverName(), ['mysql', 'mariadb'], true)) {
            DB::statement('ALTER TABLE cvs MODIFY file_blob LONGBLOB NOT NULL');
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('cvs');
    }
};