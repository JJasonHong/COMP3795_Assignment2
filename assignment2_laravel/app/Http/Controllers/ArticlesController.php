<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;
use App\Http\Resources\ArticlesResource;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Articles::where('EndDate', '>=', now())->get();
        $formattedArticles = ArticlesResource::collection($articles);
        return $formattedArticles;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Title' => 'required|string|max:255',
            'Body' => 'required|string',
            'CreatDate' => 'required|date',
            'StartDate' => 'required|date',
            'EndDate' => 'required|date',
            'ContributorUsername' => 'required|string|max:255'
        ]);

        // Sanitize inputs
        $validated['Title'] = strip_tags($validated['Title']);
        $validated['Body'] = strip_tags($validated['Body']);
        $validated['ContributorUsername'] = strip_tags($validated['ContributorUsername']);

        $article = Articles::create($validated);
        return new ArticlesResource($article);
    }

    /**
     * Display the specified resource.
     */
    public function show(Articles $article)
    {
        return new ArticlesResource($article);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Articles $article)
    {
        $validated = $request->validate([
            'Title' => 'required|string|max:255',
            'Body' => 'required|string',
            'CreatDate' => 'required|date',
            'StartDate' => 'required|date',
            'EndDate' => 'required|date',
            'ContributorUsername' => 'required|string|max:255'
        ]);

        // Sanitize inputs
        $validated['Title'] = strip_tags($validated['Title']);
        $validated['Body'] = strip_tags($validated['Body']);
        $validated['ContributorUsername'] = strip_tags($validated['ContributorUsername']);

        $article->update($validated);
        return [
            'success' => true,
            'article' => new ArticlesResource($article)
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Articles $article)
    {
        $isSuccess = $article->delete();
        return [
            'success' => $isSuccess
        ];
    }
}
