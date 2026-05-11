<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        \DB::statement("ALTER TABLE tasks MODIFY status ENUM('todo', 'in_progress', 'completed') DEFAULT 'todo'");
    }

    public function down(): void
    {
        \DB::statement("ALTER TABLE tasks MODIFY status ENUM('todo', 'in_progress', 'completed', 'submitted') DEFAULT 'todo'");
    }
};