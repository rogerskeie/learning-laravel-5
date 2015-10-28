<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class ArticlesController
 * @package App\Http\Controllers
 */
class ArticlesController extends Controller {

    public function __construct()
    {
        $this->middleware('auth', ['only' => 'create']);
    }

    /**
     * Show all published articles
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $articles = Article::latest('published_at')->published()->get();

        return view('articles.index', compact('articles'));
	}

    /**
     * Show specific article
     *
     * @param Article $article
     * @return \Illuminate\View\View
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show view for creating a new article
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if (Auth::guest()) {
            return redirect('articles');
        }
        return view('articles.create');
    }

    /**
     * Store the new article in the database
     *
     * @param ArticleRequest $request
     * @return Response
     */
    public function store(ArticleRequest $request)
    {
        Auth::user()->articles()->create($request->all());

        flash()->overlay('Your article has been successfully created!', 'Good Job');

        return redirect('articles');
    }

    /**
     * Edit an article
     *
     * @param Article $article
     * @return \Illuminate\View\View
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the article in the database
     *
     * @param Article $article
     * @param ArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Article $article, ArticleRequest $request)
    {
        $article->update($request->all());

        return redirect('articles');
    }

}
