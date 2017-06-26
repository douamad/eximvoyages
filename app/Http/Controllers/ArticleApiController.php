<?php

namespace App\Http\Controllers;

use EllipseSynergie\ApiResponse\Laravel\Response;
use Illuminate\Http\Request;
use App\Article;
use App\Transformer\ArticleTransformer;

class ArticleApiController extends Controller
{

    protected $response;
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::paginate(12);
        return $this->response->withPaginator($articles, new ArticleTransformer());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = new Article();
        $article->code = $request->input('code');
        $article->libelle = $request->input('libelle');
        $article->description = $request->input('description');
        $article->type = $request->input('type');
        $article->categorie_id = $request->input('categorie_id');
        $article->prix = $request->input('prix');

        if($article->save()){
            return $this->response->withItem($article, new ArticleTransformer());
        }else {
            return $this->response->errorInternalError('Impossible de modifier ou d\'ajouter l\'article' );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        if (!$article)
            return $this->response->errorNotFound('Article introuvable');
        return $this->response->withItem($article, new ArticleTransformer());
    }

    public function update(Request $request, $id)
    {
        $article =  Article::find($id);
        if(!$article)
            return $this->response->errorNotFound('Nous avons pas cette article');
        $article->code = $request->code;
        $article->libelle = $request->input('libelle');
        $article->description = $request->input('description');
        $article->type = $request->input('type');
        $article->categorie_id = $request->input('categorie_id');
        $article->prix = $request->input('prix');

        if($article->save()){
            return $this->response->withItem($article, new ArticleTransformer());
        }else {
            return $this->response->errorInternalError('Impossible de modifier ou d\'ajouter l\'article' );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        if(!$article)
            return $this->response->errorNotFound('Article Introuvable');
        if($article->delete()){
            return $this->response->withItem($article, new ArticleTransformer());
        } else {
            return $this->response->errorInternalError('Impossible de supprimer cet article');
        }

    }
}
