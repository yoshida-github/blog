<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; //カテゴリー情報を使用するため

class CategoryController extends Controller
{
    /**
     * 指定したカテゴリー名のブログ投稿を表示
     * 
     * @param Category
     */ 
    public function index(Category $category)
    {
        return view('categories.index')->with(['posts' => $category->getByCategory()]);
    }
}
