<?php

namespace App\Http\Controllers;

use App\IGrammerChecker;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function __construct(private IGrammerChecker $grammerChecker)
    {
    }

    public function __invoke()
    {
        $this->grammerChecker->spellChecker();
    }
}
