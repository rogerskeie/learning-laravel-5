<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Article;
use App\Http\Requests\ArticleRequest;
use App\Tag;
use Illuminate\Support\Facades\Auth;

/**
 * Class ArticlesController
 * @package App\Http\Controllers
 */
class ArticlesController extends Controller {

    /**
     * Create a new articles controller instance.
     */
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

        $tags = Tag::lists('name', 'id');

        return view('articles.create', compact('tags'));
    }

    /**
     * Store the new article in the database
     *
     * @param ArticleRequest $request
     * @return Response
     */
    public function store(ArticleRequest $request)
    {
        $this->createArticle($request);

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
        $tags = Tag::lists('name', 'id');

        return view('articles.edit', compact('article', 'tags'));
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

        $this->syncTags($article, $request->input('tag_list'));

        return redirect('articles');
    }

    /**
     * Sync up the list of tags in the database.
     *
     * @param Article $article
     * @param array $tags
     */
    private function syncTags(Article $article, array $tags)
    {
        $article->tags()->sync($tags);
    }

    /**
     * Save a new article
     *
     * @param ArticleRequest $request
     * @return mixed
     */
    private function createArticle(ArticleRequest $request)
    {
        $article = Auth::user()->articles()->create($request->all());

        $this->syncTags($article, $request->input('tag_list'));

        return $article;
    }

}
