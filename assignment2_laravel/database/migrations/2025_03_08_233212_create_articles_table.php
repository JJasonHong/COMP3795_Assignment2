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
    Schema::create('articles', function (Blueprint $table) {
        // Use bigIncrements with the name 'ArticleId' to match the query.
        $table->id('ArticleId');

        // Article title and body
        $table->string('Title');
        $table->text('Body');

        // Custom date fields.
        // Using timestamp for CreatDate (you might want to use ->useCurrent() if appropriate)
        $table->timestamp('CreatDate')->nullable();
        $table->date('StartDate')->nullable();
        $table->date('EndDate')->nullable();

        // Contributor's username
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
