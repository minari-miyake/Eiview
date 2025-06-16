<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // ここに検索処理を書く予定
        // 今は仮に検索語を表示
        $keyword = $request->input('keyword', '');
        return view('search.index', ['keyword' => $keyword]);
    }
}
