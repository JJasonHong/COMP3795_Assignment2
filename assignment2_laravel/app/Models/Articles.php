<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    /** @use HasFactory<\Database\Factories\ArticlesFactory> */
    use HasFactory;
    protected $fillable = [
        'Title',
        'Body',
        'CreatDate',
        'StartDate',
        'EndDate',
        'ContributorUsername'
    ];
}
