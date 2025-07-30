<?php

namespace App\Http\Controllers\Admin;

use PDO;
use Exception;
use App\Wed\Happy;
use App\Models\Admin\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\CategoryMaster;
use App\Models\Admin\LocationMaster;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use App\Exports\Admin\CategoryMasterExport;
use App\Imports\Admin\CategoryMasterImport;


class CategoryController extends Controller
{

    public $items, $categories, $activeCategories;

    public function __construct()
    {
        $this->items = Happy::getVendorCategoryPages();
        $this->categories = Happy::getVendorCategories();
        $this->activeCategories = Happy::getActiveCategories();
        //$this->allCategories = Happy::getActiveCategories();

        // $this->items = CategoryMaster::whereNull('parent_id')->paginate(18);
        // $this->categories = CategoryMaster::latest()->whereNull('parent_id')->orderBy('parent_id', 'ASC')->orderBy('name', 'ASC')->get();
        // $this->allCategories = CategoryMaster::with('children')->get();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //'allCategories' => $this->allCategories,

        if (auth()->guard('admin')->check()) {
            //dd($this->items, $this->categories, $this->allCategories);
            $loggedIn = auth()->guard('admin')->user();
            return view('admin.category.index', (['loggedIn' => $loggedIn, 'items' => $this->items, 'categories' => $this->categories, 'activeCategories' => $this->activeCategories]))->with('i', (request()->input('page', 1) - 1) * 18);
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
            $category = new CategoryMaster();
            return view('admin.category.create', (['loggedIn' => $loggedIn, 'categories' => $this->categories, 'category' => $category]));
        }
    }


    public function export(Request $request)
    {
        if ($request->type == 'categories') {
            return Excel::download(new CategoryMasterExport(), 'CategoryMaster.xlsx');
        }
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
            //export module
            if (isset($request->all()['excel'])) {
                $request->validate([
                    'categoryList' => 'required|mimes:csv,xlsx,xls'
                ]);
                $headings = (new HeadingRowImport(3))->toArray(request()->file('categoryList'));
                $columns = $headings[0][0];

                if ($columns[0] == 'name' && $columns[1] == 'description' && $columns[2] == 'status' && $columns[3] == 'priority' && $columns[4] == 'parent_id' && $columns[5] == 'image' && $columns[6] == 'icon' && $columns[7] == 'relation' && $columns[8] == 'path' && $columns[9] == 'admin_id') {
                    $import = new CategoryMasterImport();
                    //dd('ss');
                    try {
                        $import->import(request()->file('categoryList'));
                        //dd(CategoryMaster::all());
                    } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                        $failures = $e->failures();
                        //dd($import->errors(), $failures);
                        return redirect()->route('adminvendor.index')->with(
                            [
                                'errorStatus' => $failures,
                            ],
                        );
                    }
                    //dd('s');
                    return redirect()->route('adminvendor.index')->with([
                        'status' => 'success',
                        'message' => 'added successfully'
                    ]);
                } else {
                    return redirect()->route('adminvendor.index')->with([
                        'status' => 'Kindly select the same format',
                        'message' => 'Kindly select the same format'
                    ]);
                    //if not found show error or something
                }
            }

            $data = $this->requestValidate($request);
            $data['parent_id'] = $data['parent_id'] == 'NULL' ? NULL : $request->parent_id;
            $data['admin_id'] = auth()->guard('admin')->user()->id;
            $data['slug'] = Str::slug($request->name);
            if ($imageOne = $request->file('imageOne')) {
                $destinationPath = 'assets/defaults/categories/images/';
                $locationImage = $data['slug'] . '-' . date('YmdHis') . "." . $imageOne->getClientOriginalExtension();
                $imageOne->move($destinationPath, $locationImage);
                $data['imageOne'] = "$locationImage";
            } else {
                $data['imageOne'] = 'vendorDefault.png';
            }
            try {
                CategoryMaster::create($data);
                return redirect()->route('admincategory.index')->with([
                    'status' => 'success',
                    'message' => "$request->name added successfully."
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryMaster $category)
    {
        if (auth()->guard('admin')->check()) {
            $loggedIn = auth()->guard('admin')->user();
            return view('admin.category.show', (['category' => $category, 'categories' => $this->categories, 'loggedIn' => $loggedIn]));
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryMaster $category)
    {
        if (auth()->guard('admin')->check()) {
            $loggedIn = auth()->guard('admin')->user();
            return view('admin.category.edit', (['category' => $category, 'categories' => $this->categories, 'loggedIn' => $loggedIn]));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryMaster $category, Request $request)
    {
        if (auth()->guard('admin')->check()) {
            $data = $this->requestValidate($request);
            if ($request->parent_id == 'NULL') {
                $data['parent_id'] = $request->parent_id == 'NULL' ? NULL : $data['parent_id'];
            } else {
                $parent_id = CategoryMaster::where('id', '=', $request->parent_id)->first()->parent_id;
                $data['parent_id'] = $parent_id == null ? ($category->id == $request->parent_id ? NULL : $request->parent_id) : $parent_id;
            }

            $data['admin_id'] = auth()->guard('admin')->user()->id;
            $data['slug'] = Str::slug($request->name);
            if ($image = $request->file('imageOne')) {
                $destinationPath = 'assets/defaults/categories/images/';
                $locationImage = $data['slug'] . '-' . date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $locationImage, 'public');
                $data['imageOne'] = "$locationImage";
            } else {
                unset($data['imageOne']);
            }
            try {
                $category->update($data);
                return redirect()->route('admincategory.index')
                    ->with(['status' => 'success', 'message' => "$category->name updated successfully."]);
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
    public function destroy(CategoryMaster $category)
    {
        if (auth()->guard('admin')->check()) {
            $category->delete();

            return redirect()->route('admincategory.index')
                ->with(['status' => 'success', 'message' => "$category->name removed successfully"]);
        } else {
            return redirect()->route('admin.getlogin');
        }
    }

    public function requestValidate(Request $request)
    {
        return $this->validate(
            $request,
            [
                'name'    => ['required', 'string', 'min:3', 'max:255'],
                'description'   => ['required', 'string', 'min:3', 'max:255'],
                'priority' => ['required', 'string'],
                'parent_id' => ['required'],
                'status'  => ['required'],
                'icon' => ['sometimes', 'string', 'min:3', 'max:255'],
                'imageOne' => 'Image|sometimes|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ],
            [
                'name.required' => 'Vendor CategoryName is required & minimum 3 characters are required',
                'description.required' => 'Vendor Business Description required',
                'priority.required' => 'Choose prioirty',
                'parent_id.required' => 'Choose category',
                'status.required' => 'Choose publishing status'
            ]
        );
    }

    public function filter(Request $request)
    {
        $query = CategoryMaster::query();
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
        $items = CategoryMaster::where('id', '=', $categories[0]['id'])->paginate(9);
        // $allCategories = CategoryMaster::with('children')->get();
        $activeCategories = Happy::getActiveCategories();
        $loggedIn = auth()->guard('admin')->user();
        $admin = auth()->guard('admin')->user();
        $categories = CategoryMaster::latest()->whereNull('parent_id')->orderBy('parent_id', 'ASC')->orderBy('name', 'ASC')->get();
        return view('admin.category.index', compact('loggedIn', 'categories', 'items', 'activeCategories'));
    }
}
