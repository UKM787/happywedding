<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Admin\Tag;
use Illuminate\Http\Request;
use App\Models\Admin\Article;
use App\Traits\ImageUpload;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ArticleResource as ArticleResource;
use App\Models\Admin\CategoryMaster;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get articles
        $articles = Article::with('tags')->paginate(5);
        // $articles = Article::orderBy('created_at', 'desc')->paginate(5);
        $articleCount = Article::count();
        $loggedIn = auth()->guard('admin')->user();

        // dd($articles);
        // Return collection of articles as a resource
        return view('admin.articles.index', compact('loggedIn', 'articles', 'articleCount'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $loggedIn = auth()->guard('admin')->user();
        $article = new Article;
        //dd($article);
        //$tags = Tag::pluck('article', 'id')->filter()->all();
        //$tags = Tag::where('parent_id', NULL)->pluck('name', 'id');
        $tags = array_filter(Tag::pluck('name', 'id')->toArray());
        //$cats = CategoryMaster::where('parent_id', NULL)->pluck('name', 'id');
        $cats = CategoryMaster::where('parent_id', '!=', null)->pluck('name', 'id');
        // $lists = $this->lists;
        return view('admin.articles.create', compact('article',))->with(['tags' => $tags, 'cats' => $cats, 'loggedIn' => $loggedIn]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $data = $this->requestValidate();
        $loggedIn = auth()->guard('admin')->user();
        //$data['category_id'] = $request->category_id;
        $data['slug'] = strtolower(preg_replace('/\s+/', '-', request()->title));
        //dd($data);

        if ($image = $request->file('imageOne')) {
            $destinationPath = 'assets/defaults/articles/images/';
            $locationImage =  date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $locationImage, 'public');
            $data['imageOne'] = "$locationImage";
        } else {
            unset($data['imageOne']);
        }
        if ($request->hasfile('imageGallery')) {
            $destinationPath = 'assets/defaults/articles/images/';
            $pics = 0;
            foreach ($request->file('imageGallery') as $image) {
                if ($pics > 4) break;
                $img = time() . rand(1, 100) . '.' . $image->getClientOriginalExtension();
                //$img = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $img, 'public');
                $imgData[] = $img;
                $pics++;
            }
            $data['imageGallery'] = $imgData;
        }

        try {
            $article = $loggedIn->articles()->create($data);
            //$article = Article::create($data);
            if (request()->has('tag_list')) {
                $article->tags()->attach(request()->input('tag_list'));
            }
            if ($article) {
                return redirect()->route('adminarticles.index')->with([
                    'status' => 'success',
                    'message' => "$article->name created Successfully",
                ]);
            }
        } catch (Exception $e) {
            return redirect()->back()->with([
                'status' => 'danger',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $loggedIn = auth()->guard('admin')->user();
        return view('admin.articles.show', compact('article', 'loggedIn'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $tags = array_filter(Tag::pluck('name', 'id')->toArray());
        // $cats = CategoryMaster::where('parent_id', NULL)->pluck('name', 'id');
        $cats = CategoryMaster::where('parent_id', '!=', null)->pluck('name', 'id');
        $loggedIn =  auth()->guard('admin')->user();
        return view('admin.articles.edit', compact(['article', 'tags', 'cats',  'loggedIn']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * public function update(Request $request, $id) was earliest by default
     * fetching request from form and $id was passed automaticlly by laravel
     **/
    public function update(Article $article, Request $request)
    {

        $data = $this->requestValidate();
        $loggedIn = auth()->guard('admin')->user();
        $data['slug'] = strtolower(preg_replace('/\s+/', '-', request()->title));
        if ($image = $request->file('imageOne')) {
            $destinationPath = 'assets/defaults/articles/images/';
            $locationImage = $data['slug'] . '-' . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $locationImage, 'public');
            $data['imageOne'] = "$locationImage";
        } else {
            unset($data['imageOne']);
        }

        if ($request->hasfile('imageGallery')) {
            $destinationPath = 'assets/defaults/articles/images/';
            $pics = 0;
            foreach ($request->file('imageGallery') as $image) {
                if ($pics > 4) break;
                $img = time() . rand(1, 100) . '.' . $image->getClientOriginalExtension();
                //$img = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $img, 'public');
                $imgData[] = $img;
                $pics++;
            }
            $data['imageGallery'] = $imgData;
        }

        if (request()->priority !== $article->priority) {
            $article->update(request(['priority']));
        }
        $article->update(['status' => request()->has('status')]);

        try {
            $article->update($data + ['slug' => strtolower(preg_replace('/\s+/', '-', request()->title))]);
            // $article->update($data + ['slug' => strtolower(preg_replace('/\s+/', '-', request()->title))]);

            $article->tags()->sync(request()->input('tag_list'));


            return redirect()->route('adminarticles.index')->with([
                'status' => 'success',
                'message' => $article->title . ' was updated successfully',
            ]);
        } catch (Exception $e) {
            return redirect("adminarticles.index")->with([
                'status' => 'danger',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        // Get article
        //$article = Article::findOrFail($id);
        //dd('sss', $article->delete());
        $deleted = $article->delete();

        if ($deleted) {
            // $article->tags()->detach([$article->tags()->first()->id]);
            return back()->with([
                'status' => 'success',
                'message' => "Article Deleted Successully"
            ]);
        }
    }

    /**
     * Validatating the form data.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */

    private function requestValidate()
    {

        return request()->validate(
            [
                'title' => ['bail', 'required', 'min:5', 'max:255'],
                'body' => ['required', 'min:10', 'max:1024'],
                'excerpt' => ['sometimes'],
                'status' => ['sometimes'],
                'priority' => ['required'],
                'published_at' => ['required'],
                'tag_list'  => ['exists:tags,id'], //tag_list keys exits in tags table of database
                'category_id' => ['required'],
                'imageOne.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'imageGallery.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            ],
            [
                'title.required' => 'title required for the idea',
                'body.required' => 'descriptin required for the idea',
                'priority.required' => 'title required for the idea',
                'tag_list.required' => 'title required for the idea',
                'category_id.required' => 'category required for the idea',
                'imageOne.required' => 'cover image required for the idea',
                'imageGallery.required' => 'image gallery upto 5 images required for the idea',

            ]
        );
    }
}
