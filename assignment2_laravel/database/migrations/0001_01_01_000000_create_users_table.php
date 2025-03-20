<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            // id INTEGER PRIMARY KEY AUTOINCREMENT
            $table->id();
            // username TEXT UNIQUE NOT NULL, this will be the email address
            $table->string('username')->unique();
            // firstName TEXT NOT NULL
            $table->string('firstName');
            // lastName TEXT NOT NULL
            $table->string('lastName');
            // password TEXT NOT NULL
            $table->string('password');
            // registrationDate DATETIME DEFAULT CURRENT_TIMESTAMP
            $table->timestamp('registrationDate')->default(DB::raw('CURRENT_TIMESTAMP'));
            // isApproved INTEGER NOT NULL DEFAULT 0
            $table->boolean('isApproved')->default(false);
            // role TEXT CHECK(role IN ('Admin', 'Contributor')) DEFAULT 'Contributor'
            $table->string('role')->default('Contributor')->check("role in ('Admin', 'Contributor')");
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
