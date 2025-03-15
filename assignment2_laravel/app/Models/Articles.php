<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Models: Are used to interact with the tables created by the migrations.
 *
 * Articles Model: Used to interact with the 'articles' table in the database.
 * 
 */
class Articles extends Model
{
    /** @use HasFactory<\Database\Factories\ArticlesFactory> */
    // Laravel adds use HasFactory; to the model by default. Used to generate fake data for testing purposes.
    use HasFactory;

    // By default Laravel assumes the primary key column is named 'id'. Since we're using 'ArticleId' as the primary key, we need to explicitly specify it.
    protected $primaryKey = 'ArticleId';

    // Fillable property is used to specify which columns can be mass assigned (in insert and update operations).
    protected $fillable = [
        'Title',
        'Body',
        'CreatDate',
        'StartDate',
        'EndDate',
        'ContributorUsername'
    ];
}
