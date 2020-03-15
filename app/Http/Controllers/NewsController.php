<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Category;
use App\Http\Requests\News\UpdateNewsRequest;
use Storage;
use Auth;


class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $new = News::all();

        return view('dashboard.news_index')->with('new', $new);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('dashboard.new_create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validat data
        $validatedData = $request->validate([
            'title' => 'required|unique:news|max:255',
            'content' => 'required',
            'image' =>'required|image',

            // 'category_id'=> 'required',
        ]);

        //store data to database

        $images = $request->image->store('news');
        News::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' =>$images,
            'category_id' => $request->category,

        ]);

        //return back to news index
        return redirect()->route('news.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(){
        $news = News::orderBy('created_at', 'desc')->take(5)->get();
        $news_1 = News::where('category_id', 1)->paginate(6);
        $news_2 = News::where('category_id', 2)->paginate(6);
        $news_3 = News::where('category_id', 3)->paginate(6);
        $firstItem = News::all()->last();
        $category = Category::all();

        return view('welcome' , compact('news_1', 'news_2', 'news_3', 'category', 'news'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = News::find($id);

        return view('dashboard.new_create')->with('data',$data)->with('categories', Category::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNewsRequest $request, News $news)
    {

        $data = $request->only(['title', 'content',]);

        //check if has new image
        if($request->has('image')){
            //update image
            $image = $request->image->store('news');
            //delete the old one
            Storage::delete($news->image);

            //update the image
            $data['image'] = $image;
        }
        $data['category_id'] = $request->category;
        //update the data
        $news->update($data);

        //return back
        return redirect()->route('news.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::withTrashed()->where('id', $id)->firstOrFail();

        if($news->trashed()){
            $news->forceDelete();
            Storage::delete($news->image);
        }else{
            $news->delete();
        }

        return redirect()->back();
    }

    public function trash(){

    $news = News::onlyTrashed()->get();
    $categ= Category::onlyTrashed()->get();

    return view('dashboard.news_trash',compact('news','categ'));

    }

    public function restore($id){
        $news = News::withTrashed()->where('id', $id)->firstOrFail();
        $news->restore();

       return redirect()->route('news.index');

    }
}
