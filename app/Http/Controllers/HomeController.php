<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard(){
        $article = News::all();
        $categ = Category::all();
        return view('dashboard.admin')->with('article', $article)->with('categ', $categ);
    }

    public function show($id){
        $news = News::find($id);
        $categ = Category::all();
        return view('single-page')->with('news', $news)->with('categ', $categ);
    }

    public function showcateg($id){
        $category = Category::find($id);
        $news = Category::find($id)->news()->paginate(9);
        $categ = Category::all();
        return view('categ-page')->with('news', $news)->with('categ', $categ)->with('category', $category);
    }
}
