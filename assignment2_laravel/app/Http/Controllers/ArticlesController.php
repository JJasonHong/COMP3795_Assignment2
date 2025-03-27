<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;
use App\Http\Resources\ArticlesResource;
use Illuminate\Support\Facades\Auth;

/**
 * Controllers: Used to handle HTTP requests (GET, POST, PUT, DELETE) from the user and return responses (data).
 *  - Acts as a middleman between the model(database) and the view (UI). 
 * 
 * Once the controller recieves a request it:
 * processes it (e.g., validation, sanitization, etc...),
 * calls the model to interact with the database (it does not directly interact with the database),
 * returns the data to the user (e.g., as a response in JSON format).
 * 
 * When creating a controller using the Artisan command, Lavaravel generates the controller with the methods:
 * index() - To display a listing of the resource.
 * store() - To store a newly created resource in storage.
 * show() - To display the specified resource.
 * update() - To update the specified resource in storage.
 * destroy() - To remove the specified resource from storage.
 * 
 */
class ArticlesController extends Controller
{
    /**
     * Get/fetch all articles (specifically, articles that have not expired).
     * Formats the articles by wrapping them in the ArticlesResource and returns it in JSON format.
     * This function is automatically called when someone makes a GET request to the 'api/articles' route.
     * 
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Articles::where('EndDate', '>=', now())
            ->orderBy('CreatDate', 'desc')
            ->get();
        $formattedArticles = ArticlesResource::collection($articles);
        return $formattedArticles;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validates incoming request and stores the validated data in the $validated variable.
        $validated = $request->validate([
            'Title' => 'required|string|max:255',
            'Body' => 'required|string',
            'StartDate' => 'required|date',
            'EndDate' => 'required|date|after_or_equal:today|after_or_equal:StartDate',
            'ContributorUsername' => 'required|string|max:255'
        ]);

        // Santizes inputs by stripping HTML and PHP tags (prevents XSS attacks).
        $validated['Title'] = strip_tags($validated['Title']);
        $validated['Body'] = strip_tags($validated['Body']);
        $validated['ContributorUsername'] = strip_tags($validated['ContributorUsername']);

        // Set the creation date, start date, and end date
        $validated['CreatDate'] = now();


        // Creates a new article using the validated data by calling the create() method on the Articles model.
        $article = Articles::create($validated);
        return redirect()->route('articles.create')->with('success', 'Post created successfully!');
    }

    /**
     * 
     * Gets a single Article by finding it using the ArticleId (which is handled by Laravel automatically).
     * Wraps the article in the ArticlesResource and returns it in JSON format.
     * This function is automatically called when someone makes a GET request to the 'api/articles/{article}' route.
     * 
     * Display the specified resource.
     */
    public function show(Articles $article)
    {
        return view('articles.show', compact('article'));
    }

    public function showAPI(Articles $article)
    {
        return new ArticlesResource($article);
    }


    /**
     * Update an existing article.
     * Validates the incoming request and updates the article with the validated data.
     * Wraps the updated article in the ArticlesResource and returns it in JSON format.
     * This function is automatically called when someone makes a PUT request to the 'api/articles/{article}' route.
     * 
     * Update the specified resource in storage.
     * 
     * Use 'sometimes' for updating the article. Otherwise, the user has to provide all the fields again.
     * In an update operation, not all fields need to be updated. For example:
     * A user might want to change only the Title without modifying Body, StartDate, etc...
     * Without sometimes, they would be must send all fields.
     * The user can update only one field without needing to send all the others.
     */
    public function update(Request $request, Articles $article)
    {
        $validated = $request->validate([
            'Title' => 'sometimes|required|string|max:255',
            'Body' => 'sometimes|required|string',
            // Removed CreatDate as users should not edit it
            'StartDate' => 'sometimes|required|date',
            'EndDate' => 'required|date|after_or_equal:today|after_or_equal:StartDate',
            'ContributorUsername' => 'sometimes|required|string|max:255'
        ]);

        // Sanitize inputs if provided
        if (isset($validated['Title'])) {
            $validated['Title'] = strip_tags($validated['Title']);
        }
        if (isset($validated['Body'])) {
            $validated['Body'] = strip_tags($validated['Body']);
        }


        $article->update($validated);
        return redirect()->route('articles.create')->with('success', 'Post created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Articles $article)
    {
        $isSuccess = $article->delete();
        if ($isSuccess) {
            return redirect()->route('dashboard')->with('success', 'Article deleted successfully!');
        }
        return redirect()->route('dashboard')->with('error', 'Article deletion failed.');
    }

    public function dashboardIndex()
    {
        // Assuming you have authentication set up
        $articles = Articles::where('ContributorUsername', Auth::user()->username)->get();
        return view('dashboard', compact('articles'));
    }


    public function edit(Articles $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function create()
    {
        return view('articles.create');
    }
}
