<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;

use Carbon\Carbon;
use Request;

/**
 * Class ArticlesController
 * @package App\Http\Controllers
 */
class ArticlesController extends Controller {

    /**
     * Show all articles
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $articles = Article::latest('published_at')->get();

        return view('articles.index', compact('articles'));
	}

    /**
     * Show specific article
     * @param $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);

        return view('articles.show', compact('article'));
    }

    /**
     * Show view for creating a new article
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store the new article in the database
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        $input = Request::all();
        $input['published_at'] = Carbon::now();

        Article::create($input);

        return redirect('articles');
    }

}
