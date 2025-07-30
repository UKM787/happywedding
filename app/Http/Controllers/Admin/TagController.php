<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Admin\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{

    public $tags, $categories, $tagCount;

    public function __construct()
    {
        $this->tags =  Tag::orderBy('name', 'ASC')->paginate(30);
        $this->tagCount = Tag::all()->count();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tags = Tag::latest()->paginate(30);
        if (auth()->guard('admin')->check()) {
            $loggedIn = auth()->guard('admin')->user();
            return view('admin.tags.index', (['loggedIn' => $loggedIn, 'tags' => $this->tags, 'tagCount' => $this->tagCount]))->with('i', (request()->input('page', 1) - 1) * 30);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->guard('admin')->check()) {
            $loggedIn = auth()->guard('admin')->user();
            $tag = new Tag();
            //dd($taskcats);
            return view('admin.tags.create', (['loggedIn' => $loggedIn, 'tag' => $tag]));
        }
    }

    public function export(Request $request)
    {
        //dd('ss');
        // return Excel::download(new TaskMasterExport(), 'Tag.xlsx');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->guard('admin')->check()) {

            $data = $this->requestValidate($request);
            $data['admin_id'] = auth()->guard('admin')->user()->id;
            $data['slug'] = Str::slug($request->name);

            if ($imageOne = $request->file('imageOne')) {
                $destinationPath = 'assets/defaults/tags/images/';
                $locationImage = $data['slug'] . '-' . date('YmdHis') . "." . $imageOne->getClientOriginalExtension();
                $imageOne->move($destinationPath, $locationImage);
                $data['imageOne'] = $locationImage;
            } else {
                $data['imageOne'] = 'tagDefault.png';
            }
            //dd($data);
            try {
                //dd($data);
                $tag = Tag::create($data);
                return redirect()->route('admintag.index')->with([
                    'status' => 'success',
                    'message' =>  "$tag->name created successfully"
                ]);
            } catch (Exception $e) {
                return redirect()->back()->with([
                    'status' => 'failure',
                    'message' => $e->getMessage()
                ]);
            }
            // return redirect()->route('admin.tag.index')->with(['status' => "$tag->name added  successfully"]);

        } else {
            return redirect('admin.getlogin');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        if (auth()->guard('admin')->check()) {
            //$tag = Tag::findOrFail($tag);
            $loggedIn = auth()->guard('admin')->user();
            return view('admin.tags.show', (['loggedIn' => $loggedIn, 'tag' => $tag]));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        if (auth()->guard('admin')->check()) {
            $loggedIn = auth()->guard('admin')->user();
            return view('admin.tags.edit', (['loggedIn' => $loggedIn, 'tags' => $this->tags, 'tag' => $tag]));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Tag $tag, Request $request)
    {
        if (auth()->guard('admin')->check()) {
            //dd($request);
            $data = $this->requestValidate($request);
            // $data['status'] = $request->input('status') == 'on' ? 1 : 0;
            $data['admin_id'] = auth()->guard('admin')->user()->id;
            $data['slug'] = Str::slug($request->name);
            if ($image = $request->file('imageOne')) {
                $destinationPath = 'assets/defaults/tags/images/';
                $locationImage = $data['slug'] . '-' . date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $locationImage, 'public');
                $data['imageOne'] = "$locationImage";
            } else {
                unset($data['imageOne']);
            }
            //dd($data);
            try {
                $tag->update($data);
                return redirect()->route('admintag.index')->with([
                    'status' => 'success',
                    'message' =>  "$tag->name updated successfully"
                ]);
            } catch (Exception $e) {
                return redirect()->back()->with([
                    'status' => 'failure',
                    'message' => $e->getMessage()
                ]);
            }
        } else {
            return redirect()->route('admin.getlogin');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        if (auth()->guard('admin')->check()) {
            try {
                $tag->delete();
                return redirect()->route('admintag.index')->with([
                    'status' => 'success',
                    'message' =>  "$tag->name deleted successfully"
                ]);
            } catch (Exception $e) {
                return redirect()->route('admintag.index')->with([
                    'status' => 'failute',
                    'message' =>  "$tag->name can't be deleted being containing child tags"
                ]);
            }
        } else {
            return redirect()->route('admin.getlogin');
        }
    }

    public function requestValidate(Request $request)
    {
        return $this->validate(
            $request,
            [
                'name'    => ['required', 'string', 'min:3', 'max:256'],
                'status'  => ['required'],
                'priority' => ['required', 'string'],
                'icon' => ['sometimes', 'string', 'min:3', 'max:255'],
                'imageOne' => 'Image|sometimes|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ],
            [
                'name.required' => 'Tag Name is required & minimum 3 characters are required',
                'status.required' => 'chose publishing status',
                'priority.required' => 'Choose Tag Priority',
            ]
        );
    }

    public function getCategories()
    {
        $categories = Tag::whereNull('category_id')
            ->with('childCategories')
            ->orderby('title', 'asc')
            ->get();
        return view('categories', compact('categories'));
    }

    public function filter(Request $request)
    {
        $query = Tag::query();
        //dd($query);
        $query->when($request->categoryId, function ($q, $categoryId) {
            return $q->where('id', $categoryId);
        });
        //dd($cat);
        //->when($request->order == 'descendantDateOrder', function ($q) {
        //     return $q->orderBy('created_at', 'DESC');
        // })->when(
        //     $request->order == 'ascendantDateOrder',
        //     function ($q) {
        //         return $q->orderBy('created_at', 'ASC');
        //         $ads = $query->get();
        //         return view('ad.index', compact('ads'));
        //     }

        $categories = $query->get();
        $tags = Tag::where('id', '=', $categories[0]['id'])->paginate(9);
        $allTag = Tag::with('children')->get();
        $loggedIn = auth()->guard('admin')->user();
        $loggedIn = auth()->guard('admin')->user();
        $categories = Tag::latest()->whereNull('parent_id')->orderBy('parent_id', 'ASC')->orderBy('name', 'ASC')->get();
        return view('admin.tags.index', compact('categories', 'tags', 'allTag', 'loggedIn'));
    }
}
