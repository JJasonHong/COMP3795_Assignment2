<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Migrations: Used to define tables and columns (the structure) in the database, using the up() and down() methods.
     * 
     * The up() method should contain the instructions for creating and modifying the table.
     * The down() method should contain the instructions for reverting the changes made in the up() method.
     * 
     * When running 'php artisan migrate' in the terminal, Laravel executes the up() method to to update the database accordingly (applies migration).
     */
    public function up(): void
    {
        // Creates the 'articles' table (if it doesn't already exist)
        Schema::create('articles', function (Blueprint $table) {

            // Creates a primary key column named 'ArticleId'
            // Laravel automatically creates an auto-incrementing primary key column if you don't specify one.
            $table->id('ArticleId');

            // Creates columns for the article's title and body
            $table->string('Title');
            $table->text('Body');

            // Creates columns for the article's creation date stored as a timestamp (Date and Time)
            $table->timestamp('CreatDate')->nullable();
            
            // Creates columns for the article's start and end date stored as a date (Date only)
            $table->date('StartDate')->nullable();
            $table->date('EndDate')->nullable();

            // Creates a column for the contributor's username
            $table->string('ContributorUsername');

            // Optional: Laravel's default created_at and updated_at fields.
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
