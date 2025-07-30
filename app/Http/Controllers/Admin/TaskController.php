<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Wed\Happy;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\TaskMaster;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Admin\TaskMasterExport;
use App\Imports\Admin\TaskMasterImport;
use Maatwebsite\Excel\HeadingRowImport;
use App\Http\Resources\Admin\TaskResource;

class TaskController extends Controller
{

    public $tasks, $categories, $allTask;

    public function __construct()
    {
        $this->tasks =  Happy::getTaskCategoryPages();
        $this->categories = Happy::getTaskCategories();
        $this->allTask = TaskMaster::with('children')->get();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tasks = TaskMaster::latest()->paginate(30);
        if (auth()->guard('admin')->check()) {
            $loggedIn = auth()->guard('admin')->user();
            return view('admin.tasks.index', (['loggedIn' => $loggedIn, 'tasks' => $this->tasks, 'allTask' => $this->allTask, 'categories' => $this->categories, 'activeTasks' => Happy::getActiveTasks()]))->with('i', (request()->input('page', 1) - 1) * 30);
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
            $task = new TaskMaster();
            //dd($taskcats);
            return view('admin.tasks.create', (['loggedIn' => $loggedIn, 'task' => $task, 'categories' => $this->categories]));
        }
    }

    public function export(Request $request)
    {
        //dd('ss');
        return Excel::download(new TaskMasterExport(), 'TaskMaster.xlsx');
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

            if (isset($request->all()['excel'])) {
                $request->validate([
                    'taskList' => 'required|mimes:csv,xlsx,xls'
                ]);
                $headings = (new HeadingRowImport(3))->toArray(request()->file('taskList'));
                $columns = $headings[0][0];

                if ($columns[0] == 'name' && $columns[1] == 'description' && $columns[2] == 'status' && $columns[3] == 'priority' && $columns[4] == 'parent_id' && $columns[5] == 'image' && $columns[6] == 'icon' && $columns[7] == 'admin_id') {
                    $import = new TaskMasterImport();
                    try {
                        $import->import(request()->file('taskList'));
                        //dd('ss');
                    } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                        $failures = $e->failures();
                        //dd($import->errors(), $failures);
                        return redirect()->route('admintask.index')->with(
                            [
                                'errorStatus' => $failures,
                            ],
                        );
                    }
                    //dd('s');
                    return redirect()->route('admintask.index')->with([
                        'status' => 'success',
                        'message' => 'added successfully'
                    ]);
                } else {
                    return redirect()->route('admintask.index')->with([
                        'status' => 'Kindly select the same format',
                        'message' => 'Kindly select the same format'
                    ]);
                    //if not found show error or something
                }
            }
            $data = $this->requestValidate($request);
            $data['parent_id'] = $data['parent_id'] == 'NULL' ? NULL : $request->parent_id;
            $data['admin_id'] = auth()->guard('admin')->user()->id;
            $data['slug'] = Str::slug($request->description);

            if ($imageOne = $request->file('imageOne')) {
                $destinationPath = 'assets/defaults/tasks/images/';
                $locationImage = $data['slug'] . '-' . date('YmdHis') . "." . $imageOne->getClientOriginalExtension();
                $imageOne->move($destinationPath, $locationImage);
                $data['imageOne'] = "$locationImage";
            } else {
                $data['imageOne'] = 'taskDefault.png';
            }
            //dd($data);
            try {
                $task = TaskMaster::create($data);
                return redirect()->route('admintask.index')->with([
                    'status' => 'success',
                    'message' =>  "$task->name created successfully"
                ]);
            } catch (Exception $e) {
                return redirect()->back()->with([
                    'status' => 'failure',
                    'message' => $e->getMessage()
                ]);
            }
            // return redirect()->route('admin.task.index')->with(['status' => "$task->name added  successfully"]);

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
    public function show(TaskMaster $task)
    {
        if (auth()->guard('admin')->check()) {
            //$task = TaskMaster::findOrFail($task);
            $loggedIn = auth()->guard('admin')->user();
            return view('admin.tasks.show', (['loggedIn' => $loggedIn, 'task' => $task]));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskMaster $task)
    {
        if (auth()->guard('admin')->check()) {
            $loggedIn = auth()->guard('admin')->user();
            return view('admin.tasks.edit', (['loggedIn' => $loggedIn, 'categories' => $this->categories, 'task' => $task, 'allTask' => $this->allTask]));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskMaster $task, Request $request)
    {
        if (auth()->guard('admin')->check()) {
            $data = $this->requestValidate($request);
            // $data['status'] = $request->input('status') == 'on' ? 1 : 0;
            if ($request->parent_id == 'NULL') {
                $data['parent_id'] = $request->parent_id == 'NULL' ? NULL : $data['parent_id'];
            } else {
                $parent_id = TaskMaster::where('id', '=', $request->parent_id)->first()->parent_id;
                $data['parent_id'] = $parent_id == null ? ($task->id == $request->parent_id ? NULL : $request->parent_id) : $parent_id;
            }
            $data['admin_id'] = auth()->guard('admin')->user()->id;
            $data['slug'] = Str::slug($request->description);
            if ($image = $request->file('imageOne')) {
                $destinationPath = 'assets/defaults/tasks/images/';
                $locationImage = $data['slug'] . '-' . date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $locationImage, 'public');
                $data['imageOne'] = "$locationImage";
            } else {
                unset($data['imageOne']);
            }
            //dd($data);
            try {
                $task->update($data);
                return redirect()->route('admintask.index')->with([
                    'status' => 'success',
                    'message' =>  "$task->name updated successfully"
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
    public function destroy(TaskMaster $task)
    {
        if (auth()->guard('admin')->check()) {
            try {
                $task->delete();
                return redirect()->route('admintask.index')->with([
                    'status' => 'success',
                    'message' =>  "$task->name deleted successfully"
                ]);
            } catch (Exception $e) {
                return redirect()->route('admintask.index')->with([
                    'status' => 'failute',
                    'message' =>  "$task->name can't be deleted being containing child tasks"
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
                'name'    => ['required', 'string', 'min:3', 'max:255'],
                'description'   => ['required', 'string', 'min:3', 'max:255'],
                'priority' => ['required', 'string'],
                'parent_id' => ['sometimes'],
                'status'  => ['sometimes'],
                'icon' => ['sometimes', 'string', 'min:3', 'max:255'],
                'imageOne' => 'Image|sometimes|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ],
            [
                'name.required' => 'taskName is required & minimum 3 characters are required',
                'description.required' => 'taskDescription is required',
                'priority.required' => 'Choose Task Priority',
                'parent_id.required' => 'choose task category',
                'status.required' => 'chose publishing status'
            ]
        );
    }

    public function getCategories()
    {
        $categories = TaskMaster::whereNull('category_id')
            ->with('childCategories')
            ->orderby('title', 'asc')
            ->get();
        return view('categories', compact('categories'));
    }

    public function filter(Request $request)
    {
        $query = TaskMaster::query();
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
        $tasks = TaskMaster::where('id', '=', $categories[0]['id'])->paginate(9);
        $activeTasks = Happy::getActiveTasks();
        $loggedIn = auth()->guard('admin')->user();
        $loggedIn = auth()->guard('admin')->user();
        $categories = TaskMaster::latest()->whereNull('parent_id')->orderBy('parent_id', 'ASC')->orderBy('name', 'ASC')->get();
        return view('admin.tasks.index', compact('categories', 'tasks', 'activeTasks', 'loggedIn'));
    }
}
